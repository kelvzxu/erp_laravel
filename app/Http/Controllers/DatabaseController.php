<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class DatabaseController extends Controller
{
    /**
     * Render the database provider view.
     */
    public function provider()
    {
        return view('database.provider');
    }

    /**
     * Retrieve a list of available databases from PostgreSQL.
     */
    public function GetListDb()
    {
        return $this->queryDatabases();
    }

    /**
     * Test database connection with the provided parameters.
     */
    public function TestConnection($host, $port, $user, $password)
    {
        try {
            $this->configureTemporaryConnection($host, $port, 'postgres', $user, $password);
            DB::connection('temp')->getPdo();
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Register database credentials into .env after verification.
     */
    public function register(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'port' => 'required|numeric',
            'user' => 'required|string',
            'password' => 'nullable|string',
        ]);

        $connectionTest = $this->TestConnection(
            $request->host,
            $request->port,
            $request->user,
            $request->password
        );

        if ($connectionTest !== true) {
            return back()->withErrors(['connection' => 'Connection failed: ' . $connectionTest]);
        }

        $this->updateEnvVariables([
            'DB_CONNECTION' => 'pgsql',
            'DB_HOST' => $request->host,
            'DB_PORT' => $request->port,
            'DB_USERNAME' => $request->user,
            'DB_PASSWORD' => $request->password,
        ]);

        $databaseList = $this->queryDatabases();
        if (count($databaseList) > 0) {
            return redirect()->route('database.selector')->with('success', 'Connection successful! Database list retrieved.');
        }

        return redirect()->route('database.create')->with('success', 'Connection successful! No databases found, please create one.');
    }

    /**
     * Render the database selector view.
     */
    public function DatabaseSelector()
    {
        return view('database.selector', ['databases' => $this->queryDatabases()]);
    }

    /**
     * Set the active database in .env and reload configuration.
     */
    public function DatabaseSetup(Request $request)
    {
        $database = $request->query('db');
        if (!$database) {
            abort(404, 'Database not specified.');
        }

        $this->updateEnvVariables(['DB_DATABASE' => $database]);
        return redirect('/')->with('success', 'Environment variables updated successfully!');
    }

    /**
     * Create a new database.
     */
    public function DatabaseCreate(Request $request)
    {
        $request->validate([
            'master_pwd' => 'required|string',
            'name' => 'required|string|regex:/^[a-zA-Z0-9][a-zA-Z0-9_.-]+$/',
            'email' => 'required|email',
            'password' => 'required|string',
            'company' => 'required|string',
            'phone' => 'required|string',
        ]);

        $dbName = $request->input('name');

        try {
            DB::statement("CREATE DATABASE \"$dbName\"");

            $this->configureDynamicConnection($dbName);
            DB::connection('dynamic')->getPdo();

            \Artisan::call('migrate', ['--database' => 'dynamic']);
            return redirect()->route('database.selector')->with('success', "Database '$dbName' created successfully!");
        } catch (\Exception $e) {
            Log::error("Error creating database '$dbName': " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Delete a database after verifying the master password.
     */
    public function DatabaseDestroy(Request $request)
    {
        $request->validate([
            'db' => 'required|string',
            'master_password' => 'required|string',
        ]);

        $dbName = $request->input('db');
        $masterPassword = $request->input('master_password');

        try {
            if (Crypt::decryptString(env('APP_PASSWD')) === $masterPassword) {
                DB::statement("DROP DATABASE \"$dbName\"");
                return redirect()->back()->with('success', "Database '$dbName' deleted successfully!");
            }

            return redirect()->back()->withErrors(['error' => 'Invalid master password.']);
        } catch (\Exception $e) {
            Log::error("Error deleting database '$dbName': " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Set the master password.
     */
    public function setMasterPassword(Request $request)
    {
        $request->validate([
            'master_password' => 'required|string|min:8',
            'confirm_master_password' => 'required|string|same:master_password',
        ]);

        try {
            $this->updateEnvVariables([
                'APP_PASSWD' => Crypt::encryptString($request->input('master_password')),
            ]);
            return redirect()->back()->with('success', 'Master password set successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to set master password: ' . $e->getMessage()]);
        }
    }

    /**
     * Helper: Query all databases except templates.
     */
    private function queryDatabases()
    {
        $databases = DB::select("SELECT datname FROM pg_database WHERE datistemplate = false AND datname != 'postgres';");
        return array_column($databases, 'datname');
    }

    /**
     * Helper: Configure a temporary database connection.
     */
    private function configureTemporaryConnection($host, $port, $database, $user, $password)
    {
        config([
            'database.connections.temp' => [
                'driver' => 'pgsql',
                'host' => $host,
                'port' => $port,
                'database' => $database,
                'username' => $user,
                'password' => $password,
            ],
        ]);
    }

    /**
     * Helper: Configure a dynamic database connection.
     */
    private function configureDynamicConnection($database)
    {
        config([
            'database.connections.dynamic' => [
                'driver' => 'pgsql',
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'database' => $database,
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
            ],
        ]);
    }

    /**
     * Helper: Update environment variables in the .env file.
     */
    private function updateEnvVariables(array $variables)
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        foreach ($variables as $key => $value) {
            if (str_contains($envContent, "$key=")) {
                $envContent = preg_replace("/^$key=.*$/m", "$key=\"$value\"", $envContent);
            } else {
                $envContent .= "\n$key=\"$value\"";
            }
        }

        file_put_contents($envPath, $envContent);
        \Artisan::call('config:clear');
    }
}
