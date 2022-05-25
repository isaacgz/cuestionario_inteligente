<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Postmark\PostmarkClient;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }


    public function newRegister(Request $request)
    {
        $fsname = $request->json('fsname');
        $lsname = $request->json('lsname');
        $email = $request->json('email');
        $password = $request->json('password');
        $ip = $this->get_client_ip();
        $errors = 0;
        $url_Portal = "http://150.136.42.153:8081/login";
        try {                     
            if ($fsname != ""  && $lsname != ""  && $email != "" && $password != "" ) 
            {
                $image = "";                              
                $role_name = "Cliente";
                $id_role = 2;
                $active = 1;

        
                $model = new User();
                    $model -> id_role = $id_role;
                    $model -> assignRole($role_name);
                    $model -> name = $fsname. " ".$lsname;
                    $model -> email = $email;
                    $model -> password = Hash::make($password);
                    $model -> image = $image;
                    $model -> active = $active;    
                    $model -> dark_mode = 0;    
                $model ->save();

                $id_user = User::with('id')->max('id');       
                // dd($id_user);
                    
            }else{
                $errors++;
            }
            if($errors==0){
                $this->logRegister(1, $fsname, $id_user,$ip);
                return response()->json([url('/login')], 200);
            }else{
                return response()->json('', 422);
            }
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    //Obtiene la IP del cliente
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function logRegister($event, $name, $id, $ip){
        
        switch ($event) {
            case 1: $e = 'store';
                    $t = 'User created, id: '.$id.' name'.$name;
                break;         
        }
        Log::channel('new_register')->info('['.$e.']['.$t.']['.$id.']['.$ip.']');    
    }
}
