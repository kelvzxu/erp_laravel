<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function provider()
    {   
        return view('database.provider');
        // echo "Database Provider";
    }

    /**
     * Register any application services.
     */
    public function register(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'port' => 'required|numeric',
            'user' => 'required|string',
            'password' => 'nullable|string',
        ]);

        // Path ke file .env
        $envPath = base_path('.env');

        // Ambil isi file .env
        $envContent = file_get_contents($envPath);

        $envContent = preg_replace('/^DB_CONNECTION=.*$/m', 'DB_CONNECTION=psql', $envContent);
        // Update nilai host
        $envContent = preg_replace('/^DB_HOST=.*$/m', 'DB_HOST=' . $request->host, $envContent);

        // Update nilai port
        $envContent = preg_replace('/^DB_PORT=.*$/m', 'DB_PORT=' . $request->port, $envContent);

        // Update nilai username
        $envContent = preg_replace('/^DB_USERNAME=.*$/m', 'DB_USERNAME=' . $request->user, $envContent);

        // Update nilai password (jika ada)
        $envContent = preg_replace('/^DB_PASSWORD=.*$/m', 'DB_PASSWORD=' . $request->password, $envContent);

        // Tulis kembali ke file .env
        file_put_contents($envPath, $envContent);

        // // Bersihkan cache konfigurasi
        \Artisan::call('config:clear');

        return redirect('/')->with('success', 'Environment variables updated successfully!');
        // return response()->json(['message' => 'Environment variables updated successfully!']);
    }

    public function DatabaseSelector()
    {
        $databases = DB::select("SELECT datname FROM pg_database WHERE datistemplate = false and datname != 'postgres';");

        // Konversi hasil query menjadi array sederhana
        $databaseList = array_map(function ($db) {
            return $db->datname;
        }, $databases);

        return view('database.selector', ['databases' => $databaseList]);
    }
}
