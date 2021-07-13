<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $master_passwd = false;
        if (!env('APP_PASSWD')){
            $master_passwd = $this->GeneratePasswd();
        }
        return view('web.datasource',compact('master_passwd'));
    }
    
    public function CreateDatabase(){
        $datasource = $this->CheckDatasource();
        if ($datasource == 'Success'){
            return view('web.create_database');
        }else{
            return redirect()->route('RegisterDatasource');
        }
    }

    public function DatasourceSaved(Request $request){
        echo(env('APP_PASSWD'));
        echo"<br>";
        echo"-----";
        echo"<br>";
        echo($request->master_pwd);
        if (env('APP_PASSWD') === $request->master_pwd){
            echo"true";
            $path = base_path('.env');
            $Host = env('DB_HOST');
            $Port = env('DB_PORT');
            $User = env('DB_USERNAME');
            $Password = env('DB_PASSWORD');


            file_put_contents($path, str_replace(
                'DB_HOST='.$Host, 'DB_HOST='.$request->host, file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'DB_PORT='.$Port, 'DB_PORT='.$request->port, file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'DB_USERNAME='.$User, 'DB_USERNAME='.$request->user, file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                'DB_PASSWORD='.$Password, 'DB_PASSWORD='.$request->password, file_get_contents($path)
            ));

            return redirect()->route('CreateDatabase');
        }else{
            echo"false";
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
