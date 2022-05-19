<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Ver_roles|Crear_roles|Editar_roles|Eliminar_roles',['only' => ['index']]);
        $this->middleware('permission:Crear_roles',['only' => ['create', 'store']]);
        $this->middleware('permission:Editar_roles',['only' => ['edit', 'update']]);
        $this->middleware('permission:Eliminar_roles',['only' => ['destroy']]);
    }

        /**
     * Display register user list view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {            
        $permission = Permission::all();   
        return view('system.roles.report', array("permission" => $permission));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        
        try {
            DB::beginTransaction();
            $opciones = $request->json('permission');
            $name = $request->json('name');
            $errors = 0;

            if ($name != "") {
                $role = Role::create(['name'=> $name]);                
                $role->syncPermissions($opciones);
                $id_role = Role::with('id')->max('id');
            }else{
                $errors++;
            }

            if($errors==0){
                $this->logRegister(1, $name, $id_role);
                DB::commit();   
                return response()->json(null, 200);
            }else{
                DB::rollback();
                return response()->json('', 422);
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
                            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                            ->all();
                                
        // dd($rolePermissions);
        return view('system.roles.edit', compact('role','permission','rolePermissions'));


    }
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);        
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)->get();

        return response()->json(['role' => $role, 'rolePermissions' => $rolePermissions], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // dd($request->json('permission'));
            $id = $request->json('id');
            $name = $request->json('name');            
            // dd($id);
            $role = Role::find($id);//Get role with the given id
            $errors = 0;

            if ($name != "") {
                
                $per_all = Permission::all();//Traigo todos los permisos                
                // dd($per_all);
                $permissions = $request->json('permission');

                if ($per_all != null) {                    
                    foreach ($per_all as $p) {
                        $role->revokePermissionTo($p); //Quito todos los roles actuales amonoooos
                    }
                }
                foreach ($permissions as $permission) {
                    $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
                    $role->givePermissionTo($p);  //Assign permission to role
                }
                $role->name = $name;
                $role->save();

            }else{
                $errors++;
            }

            if($errors==0){
                $this->logRegister(2, $role->name, $role->id);
                return response()->json(null, 200);
            }else{
                return response()->json('', 422);
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
        // dd(($id));
        $count += User::where('id_role', $id)->count();

        if($count==0){
            Role::destroy($id);
            $this->logRegister(3, '', $id);
            return response()->json(null, 200);
        }else{
            return response()->json(null, 403);
        }

    }

    /**
     * Get Roles from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRoles(){
        $data = Role::orderBy('name', 'asc')->get();
        return response()->json($data, 200);
    }

    public function logRegister($event, $name, $id)
    {
        switch ($event) {
            case 1: $e = 'store';
                    $t = 'Resource created, role name: '.$name;
                break;
            case 2: $e = 'update';
                    $t = 'Edited resource, role name: '.$name;
                break;
            case 3: $e = 'delete';
                    $t = 'Resource deleted';
                break;   
        }
        Log::channel('crud_role')->info('['.$e.']['.$t.']['.$id.']['.Auth::id().']');    
    }
}
