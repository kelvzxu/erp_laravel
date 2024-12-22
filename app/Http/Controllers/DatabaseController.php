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

    private function createDefaultData($request, $connection)
    {
        $partnerId = $this->createPartner(
            $request->input('company'),
            $request->input('email'),
            $connection 
        );

        $this->createUser(
            $request->input('company'),
            $request->input('email'),
            $request->input('password'),
            $request->input('phone'),
            $partnerId,
            $connection 
        );
    }

    /**
     * Create a new database.
     *
     * This function uses a SQL `CREATE DATABASE` statement to create a new PostgreSQL database.
     * Logs the success or failure of the operation. Throws an exception if the creation fails.
     *
     * @param string $dbName The name of the database to create.
     * @throws \Exception If the database creation fails.
     * @return void
     */
    private function createDatabase($dbName)
    {
        try {
            DB::statement("CREATE DATABASE \"$dbName\"");
            Log::info("Database '$dbName' created successfully.");
        } catch (\Exception $e) {
            Log::error("Error creating database '$dbName': " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Run migrations on the dynamic database connection.
     *
     * This function uses Laravel's Artisan command to execute database migrations
     * for the `dynamic` connection. It logs the success or failure of the operation.
     *
     * @throws \Exception If the migrations fail to run.
     * @return void
     */
    private function runMigrations()
    {
        try {
            \Artisan::call('migrate', ['--database' => 'dynamic']);
            Log::info("Migrations executed successfully on dynamic connection.");
        } catch (\Exception $e) {
            Log::error("Error running migrations: " . $e->getMessage());
            throw $e;
        }
    }


    /**
     * Run seeders on the dynamic database connection.
     *
     * This function uses Laravel's Artisan command to execute the `DataSeeder`
     * class on the `dynamic` connection. It logs the success or failure of the operation.
     *
     * @throws \Exception If the seeders fail to run.
     * @return void
     */
    private function runSeeders()
    {
        try {
            // Execute the seeders using Artisan command for the dynamic connection
            \Artisan::call('db:seed', [
                '--class' => 'DataSeeder', 
                '--database' => 'dynamic',
            ]);

            // Log a success message for tracking the seeding process
            Log::info("Seeders executed successfully on dynamic connection.");
        } catch (\Exception $e) {
            // Log an error message with the exception details
            Log::error("Error running seeders: " . $e->getMessage());

            // Re-throw the exception to notify the calling function of the failure
            throw $e;
        }
    }



    /**
     * Create a partner in the res_partner table.
     *
     * @param string $name
     * @param string $email
     * @param \Illuminate\Database\Connection $connection
     * @return int Partner ID
     */
    private function createPartner($name, $email, $connection)
    {
        try {
            $partnerId = $connection->table('res_partner')->insertGetId([
                'name' => $name,
                'email' => $email,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info("Partner '$email' created successfully with ID $partnerId.");
            return $partnerId;
        } catch (\Exception $e) {
            Log::error("Error creating partner '$email': " . $e->getMessage());
            throw $e;
        }
    }


    /**
     * Create a user in the res_users table.
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $phone
     * @param int $partnerId
     * @param \Illuminate\Database\Connection $connection
     * @return void
     */
    private function createUser($name, $email, $password, $phone, $partner, $connection)
    {
        try {
            $connection->table('res_users')->insert([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'partner_id' => $partner,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info("User '$email' created successfully in the database.");
        } catch (\Exception $e) {
            Log::error("Error creating user '$email': " . $e->getMessage());
            throw $e;
        }
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
        $masterPassword = $request->input('master_pwd');

        return $this->validateAndProceed($masterPassword, function () use ($dbName, $request) {
            try {
                $this->createDatabase($dbName);
    
                $this->configureDynamicConnection($dbName);
                $connection = DB::connection('dynamic');
                $connection->getPdo();
    
                $this->runMigrations();
                $this->runSeeders();
                $this->createDefaultData($request, $connection);
    
                return redirect()->route('database.selector')->with('success', "Database '$dbName' created successfully!");

            } catch (\Exception $e) {
                Log::error("Error creating database '$dbName': " . $e->getMessage());
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        });
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
        return $this->validateAndProceed($masterPassword, function () use ($dbName) {
            try {
                DB::statement("DROP DATABASE \"$dbName\"");
                return redirect()->back()->with('success', "Database '$dbName' deleted successfully!");
            } catch (\Exception $e) {
                Log::error("Error deleting database '$dbName': " . $e->getMessage());
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        });
    }

    /**
     * Verify the master password against the stored encrypted password.
     *
     * @param string $masterPassword The master password to verify.
     * @return bool Returns true if the password matches, false otherwise.
     * @throws \Exception If the decryption fails.
     */
    private function verifyMasterPassword($masterPassword)
    {
        try {
            // Decrypt the stored password from the environment and compare
            return Crypt::decryptString(env('APP_PASSWD')) === $masterPassword;
        } catch (\Exception $e) {
            Log::error("Error verifying master password: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Validate master password and execute a callback.
     *
     * @param string $masterPassword The master password provided by the user.
     * @param \Closure $callback A callback function to execute if the password is valid.
     * @return mixed
     */
    private function validateAndProceed($masterPassword, \Closure $callback)
    {
        if ($this->verifyMasterPassword($masterPassword)) {
            return $callback();
        }
        
        return back()->withErrors(['master_pwd' => 'Incorrect master password']);
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

}
