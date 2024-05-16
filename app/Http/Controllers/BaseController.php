<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    public function AuthorizesDatabase(){
        $datasource = $this->CheckDatasource();
        if ($datasource != 'Success'){
            return redirect()->route('RegisterDatasource');
        }
        else{  
            return redirect()->route('CreateDatabase');
        }
    }
    
    public function CheckDatasource(){
        $path = base_path('.env');
        $Host = env('DB_HOST');
        $Port = env('DB_PORT');
        $User = env('DB_USERNAME');
        $Password = env('DB_PASSWORD');
        $Database = 'pgsql';
        
        if (env('DB_CONNECTION') == 'mysql'){
            file_put_contents($path, str_replace(
                'DB_CONNECTION=mysql', 'DB_CONNECTION='.$Database, file_get_contents($path)
            ));
        }

        if ($Host && $Port && $User && $Password ){
            $connection = $this->TryConnection($Host, $Port, $User, $Password);
            if ($connection == 'Success'){
                return 'Success';
            }else{
                return $connection;
            }
        }else{
            return 'failed';
        }
    }
    
    public function TryConnection($Host, $Port, $User, $Password){
        try {
            // Menggunakan Database Manager Laravel untuk membuat koneksi
            DB::connection()->getPdo();
            // Jika tidak ada exception yang terjadi, koneksi berhasil
            return true;
        } catch (\Exception $e) {
            // Tangani exception yang terjadi
            // Anda bisa menambahkan langkah-langkah khusus di sini
            return false;
        }

    }
    
    public function DatasourceRegistration(){
        $master_passwd = false;
        if (!env('APP_PASSWD')){
            $master_passwd = $this->GeneratePasswd();
        }
        return view('datasource',compact('master_passwd'));
    }
    
    public function CreateDatabase(){
        $datasource = $this->CheckDatasource();
        if ($datasource == 'Success'){
            return view('create_database');
        }else{
            return redirect()->route('RegisterDatasource');
        }
    }

    public function DatasourceSaved(Request $request)
    {
        // Cek apakah kata sandi master yang dimasukkan oleh pengguna cocok dengan yang ada di ENV
        if (env('APP_PASSWD') === $request->master_pwd) {
            // Mengambil path ke file .env
            $path = base_path('.env');
            
            // Mengganti nilai DB_HOST dengan yang baru
            file_put_contents($path, preg_replace('/^DB_HOST=.*/m', 'DB_HOST='.$request->host, file_get_contents($path)));
            // Mengganti nilai DB_PORT dengan yang baru
            file_put_contents($path, preg_replace('/^DB_PORT=.*/m', 'DB_PORT='.$request->port, file_get_contents($path)));
            // Mengganti nilai DB_USERNAME dengan yang baru
            file_put_contents($path, preg_replace('/^DB_USERNAME=.*/m', 'DB_USERNAME='.$request->user, file_get_contents($path)));
            // Mengganti nilai DB_PASSWORD dengan yang baru
            file_put_contents($path, preg_replace('/^DB_PASSWORD=.*/m', 'DB_PASSWORD='.$request->password, file_get_contents($path)));

            // Redirect ke root URL setelah berhasil menyimpan perubahan
            return redirect('/');
        } else {
            echo "false";
        }
    }


    public function GeneratePasswd(){
        $path = base_path('.env');
        $x = 1;
        $password = '';
        while($x <= 4) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = $password . substr( str_shuffle( $chars ), 0, 4 ) ;
            $x++;
            if($x <= 4)
            {
                $password = $password . '-';
            }
        } 
        file_put_contents($path, str_replace(
            'APP_PASSWD=', 'APP_PASSWD='.$password, file_get_contents($path)
        ));
        return $password;
    }
}