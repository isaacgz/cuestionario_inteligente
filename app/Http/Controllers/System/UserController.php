<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\EmployeeImport;
use App\Models\Advance;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

use CraigPaul\Mail\TemplatedMailable;
use Illuminate\Support\Facades\Mail;

use Postmark\PostmarkClient;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Ver_usuarios|Crear_usuarios|Editar_usuarios|Eliminar_usuarios',['only' => ['index']]);
        $this->middleware('permission:Crear_usuarios',['only' => ['create', 'store']]);
        $this->middleware('permission:Editar_usuarios',['only' => ['edit', 'update']]);
        $this->middleware('permission:Eliminar_usuarios',['only' => ['destroy']]);
    }
    /**
     * Display register user list view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $roles = Role::all();  
        return view('system.users.report', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {              
        $image = "";
        if($request->archivo != "undefined"){
            $path = $request->file('archivo')->store('users', 'public');        
            if($path != ""){
                $image = $path;            
            }else{
                $image = "";
            }
        }else{
            $image = "";
        }

        $role_name = Role::where('id',intval($request->role))->pluck('name');

        $model = new User();
            $model -> name = $request->name;
            $model -> email = $request->email;
            $model -> password_txt = $request->password;
            $model -> password = Hash::make($request->password);
            $model -> assignRole($role_name[0]);
            $model -> id_role = $request->role;
            $model -> image = $image;
            $model -> active = $request->active;            
        $model ->save();

        $this->logRegister(1, $model->name, $model->id);

        return response()->json(null, 200);
    }
   /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::where('id', $id)->get();
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {     
        try {
                DB::beginTransaction();  
                $avatar_remove = intval($request->avatar_remove);
                $id = intval($request->id);
                $errors = 0;
                $image = "";
                $usr = DB::table('sys_users as a')->select('a.image')->where('id', $id)->get();

                #Si el usuario cambia su foto, elimina la anterior y obtiene el path de la nueva
                if($request->archivo != "undefined"){
                    $path = $request->file('archivo')->store('users', 'public');        
                    if($path != ""){                        
                        if (Storage::exists("public/".$usr[0]->image))
                        {
                            Storage::delete("public/".$usr[0]->image);
                        }                        
                        $image = $path;            
                    }else{
                        $image = $usr[0]->image;
                    }
                }else if ($avatar_remove == 1) {
                    $image = "";
                }else{
                    $image = $usr[0]->image;
                }
                
                #Hacer hash a password
                $password = "";
                if(!empty($request->password)){
                    $password = Hash::make($request->password);
                }
            
                #Si el usuario quiere quitar solo su imagen
                if ($avatar_remove == 1) {              
                    if (Storage::exists("public/".$usr[0]->image))
                    {
                        Storage::delete("public/".$usr[0]->image);
                    }
                }

                #Consulta el nombre del rol que se va a insertar
                $role_name = Role::where('id',intval($request->role))->pluck('name');
             
                #Hace el update en la tabla
                $affected = DB::table('sys_users')
                    ->where('id', $id)
                    ->update(['name'    => $request->name,
                            'email'     => $request->email,
                            'id_role'   => $request->role,
                            'image'     => $image,
                            'active'    => $request->active
                        ]);
                if ($affected == 0) {
                    $errors++;
                }
                
            if($errors==0){
                DB::commit();
                $model = User::find($id);                                        
                    $model -> password_txt = $password != "" ? $password : $model -> password_txt;
                    $model -> password = $password != "" ? $password : $model -> password;
                    $model -> assignRole($role_name[0]);
                $model ->save();
                $this->logRegister(2, $model->name, $model->id);
                return response()->json(null, 200);
            }else{
                DB::rollback();
                return response()->json("", 422);
            }
      
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $count=0;
        $id = $request->json('id');

        
        // $count += Advance::where('id_usuario', $id)->count();

        if($count==0){
            $usr = DB::table('sys_users as a')
                ->select('a.image'                    
            )->where('id', $id)->get();

            foreach ($usr as $key) {
                Storage::delete("public/".$key->image);                
            }
            User::destroy($id);
            $this->logRegister(3, '', $id);
            return response()->json(null, 200);
        }else{
            return response()->json(null, 403);
        }
    }

    /**
     * Update the dark_mode 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dark_mode(Request $request)
    {
        $user = User::find($request->json('id'));
        $user -> dark_mode = $request->json('dark_mode');
        $user -> save();
    }
    /**
     * Get users from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUsers(){

        $data = User::select('sys_users.*', 'roles.name AS role_name')
            ->join('roles', 'roles.id', '=', 'sys_users.id_role')
            ->orderBy('id','ASC')
            ->get();

        return response()->json($data, 200);
    }
    /**
     * Display masive import view.
     *
     * @return \Illuminate\Http\Response
     */
    public function masiveImport()
    {  
        return view('system.users.import');
    }

    /**
     * Read data from excel and create the collection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importAllEmployee(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();     

        if($extension == 'xlsx' || $extension=='xls'){
            $fila = 0;
            $data_exists = new Collection();
            $data_noExists = new Collection();
         
            $collection = Excel::toCollection(new EmployeeImport(), $file);
            // dd($collection);
            foreach ($collection as $row) {
                foreach($row  as $val){
                    $fila++;
                    //Datos de excel                    
                    $fullName = isset($val[0]) ? trim($val[0]) : '';
                    $email = isset($val[1]) ? trim($val[1]) : '';                   
                    //validamos y armamos
                    // dd($numberSAP);
                    if($fullName != "" && $email != ""){
                        if($fila>1){
                            $data_exists->push((object)[
                                'id' => $fila,
                                'fullName' => $fullName,
                                'email' => $email                            
                            ]);
                        }
                    }else{
                        if($fila>1){
                            if($fullName == ""){
                                $error = 1;
                            }else if($email == ""){
                                $error = 2;                             
                            }
                            $data_noExists->push((object)[
                                'id' => $fila,
                                'fullName' => $fullName,
                                'email' => $email,
                                'error' => $error,
                            ]);
                        }
                    }
                }
            }

            /** Empleados */
            $employees = $data_exists->values();
           
            return response()->json(['employees' => $employees->all(),'data_noExists' => $data_noExists->all()], 200);
        }else{
            return response()->json('Error en formato', 422);
        }
    }

    /**
     * Store a import data of employees in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeEmployeeImport(Request $request)
    {        
        
        $data_employees = $request->json('data_employees');        
        $date_request = $request->json('date_request');
        $errors = 0;
        $url_Portal = "http://150.136.42.153:8080/login";
        
        // dd($data_employees);
        try {
            DB::beginTransaction();

            //Obtener datos
            foreach($data_employees as $valor) 
            {
                // dd($valor);
                $fullName   = $valor['fullName'];
                $email      = $valor['email'];
                
                              
                // $this->logRegister(4, $msg, '');
                if ($fullName != "" && $email != "") {
                    /** Insert employee */
                    $role_name = Role::where('id',2)->pluck('name');
                    
                    $random_string = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90));                  
                        $model = new User();
                        $model -> name = $fullName;
                        $model -> email = $email;
                        $model -> password_txt = $random_string;
                        $model -> password = Hash::make($random_string);
                        $model -> assignRole($role_name[0]);
                        $model -> id_role = 2;                     
                        $model -> active = 1;            
                        $model -> created_at = $date_request; 
                    $model ->save();
                        
                        //Enviar correo                                
                        $client = new PostmarkClient("b9f2a870-9db9-47b2-bb4d-419282eb8065");                

                        $res = $client->sendEmailWithTemplate(
                            "recepcionbancodav@factura1.com.co",
                            $email,
                            27072990,
                            array(
                                'nombre_empleado'   => $fullName, 
                                'url_portal'        => $url_Portal,
                                'nombre_usuario'    => $email,
                                'codigo'            => $random_string
                            )
                        );
                        $reees = $res->to." ".$res->submittedat." ".$res->messageid." ".$res->errorcode." ".$res->message;
                        
                        $this->logRegister(4, $reees, '');

                        DB::commit();                   
                }else{
                    $errors++;
                }      

            }//for employees    
            
            if($errors==0){                                        
                return response()->json(null, 200);
            }else{
                DB::rollback();
                $msg = 'El empleado: '.$fullName.' contiene errores, valide la información';
                $this->logRegister(4, $msg, '');
                return response()->json($msg, 422);
            }         
        }catch (\Exception $e){
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
    }

    public function logRegister($event, $name, $id)
    {
        switch ($event) {
            case 1: $e = 'store';
                    $t = 'Resource created, user name: '.$name;
                break;
            case 2: $e = 'update';
                    $t = 'Edited Resource, user name: '.$name;
                break;
            case 3: $e = 'delete';
                    $t = 'Resource deleted';
                break;
            case 4: $e = 'import';
                    $t = 'User(s) imported res: '.$name;
            break;   
        }
        Log::channel('crud_user')->info('['.$e.']['.$t.']['.$id.']['.Auth::id().']');    
    }

}
