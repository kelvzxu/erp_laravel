<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class CheckDatabaseConfig
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Cek konfigurasi dari .env
        $envDbHost = env('DB_HOST');
        $envDbConnection = env('DB_CONNECTION');
        $envDbPort = env('DB_PORT');

        // Cek konfigurasi dari config/database.php
        $configDbHost = Config::get('database.connections.' . Config::get('database.default') . '.host');
        $configDbConnection = Config::get('database.default');
        $configDbPort = Config::get('database.connections.' . Config::get('database.default') . '.port');

    

        // Pastikan halaman saat ini bukan `/web/database/provider`
        if (!$request->is('web/database/provider') && !$request->is('web/database/provider/register')) {
            // Redirect jika konfigurasi tidak lengkap
            if (
                (!$envDbHost || !$envDbConnection || !$envDbPort) && // Cek .env
                (!$configDbHost || !$configDbConnection || !$configDbPort) // Cek config/database.php
            ) {
                return redirect('/web/database/provider');
            }
        }

        return $next($request);
    }

}

