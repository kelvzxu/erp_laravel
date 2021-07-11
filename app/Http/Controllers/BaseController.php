<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function AuthorizesDatabase(){
        $datasource = $this->CheckDatasource();
        if ($datasource == 'Success'){
            return redirect()->route('CreateDatabase');
        }else{  
            return redirect()->route('RegisterDatasource');
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
        try{
            $db_handle = pg_connect("host=$Host dbname=postgres user=$User password=$Password");
            if ($db_handle) {
                return 'Success';
            } else {
                return 'failed';
            }
        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    
    public function DatasourceRegistration(){
        return view('web.datasource');
    }
    
    public function CreateDatabase(){
        return view('web.create_database');
    }
}
