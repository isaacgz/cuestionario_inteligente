<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DocType;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocTypeController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Ver_TiposDocumentos|Crear_TiposDocumentos|Editar_TiposDocumentos|Eliminar_TiposDocumentos',['only' => ['index']]);
        $this->middleware('permission:Crear_TiposDocumentos',['only' => ['create', 'store']]);
        $this->middleware('permission:Editar_TiposDocumentos',['only' => ['edit', 'update']]);
        $this->middleware('permission:Eliminar_TiposDocumentos',['only' => ['destroy']]);
    }

        /**
     * Display register user list view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {            
        return view('system.doctype.report');
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
            $name = $request->json('name');
            $active = $request->json('active');
            $errors = 0;

            if ($name != "") {
                $doctype = DocType::create(['name'=> $name,'active' => $active]);
                $id_doctype = DocType::with('id')->max('id');
            }else{
                $errors++;
            }

            if($errors==0){
                $this->logRegister(1, $name, $id_doctype);
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
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $DocType = DocType::find($id);       

        return response()->json(['DocType' => $DocType], 200);
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
            $active = $request->json('active');            
            // dd($active);
           
            $errors = 0;

            if ($name != "") {
                
                $doctype = DocType::find($id);//Get role with the given id
                    $doctype->name = $name;
                    $doctype->active = $active;
                $doctype->save();

            }else{
                $errors++;
            }

            if($errors==0){
                $this->logRegister(2, $name, $id);
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
        //Datos fiscales
        // $count += User::where('id_role', $id)->count();

        if($count==0){
            DocType::destroy($id);
            $this->logRegister(3, '', $id);
            return response()->json(null, 200);
        }else{
            return response()->json(null, 403);
        }

    }

    /**
     * Get Doctype from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDoctype(){
        $data = DocType::orderBy('name', 'asc')->get();
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
