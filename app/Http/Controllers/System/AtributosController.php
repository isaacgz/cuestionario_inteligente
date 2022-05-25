<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Atributos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AtributosController extends Controller
{
    /**
     * Display register user list view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {              
        
        return view('system.atributos.report');
    }

    public function store(Request $request)
    {
        try {
            // dd($request);
            DB::beginTransaction();   
            $id_usuario = Auth::user()->id;         
            $text = $request->json('text');
            $active = $request->json('active');
           
            $errors = 0;

            if ($text != "") {
                DB::table('atributos_animales')->insert([                
                    'texto'  => $text,
                    'active'   => $active,
                    'created_at'        => \Carbon\Carbon::now()
                ]);
            }else{
                $errors++;
            }
            if($errors==0){
                DB::commit();   
                // $this->logRegister(1, trim($request->json('reference')), $id_advance);
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
        $animal = Atributos::find($id);       

        return response()->json(['Animal' => $animal], 200);
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
            
            $id = $request->json('id');
            $name = $request->json('name');            
            $active = $request->json('active');            
    
           
            $errors = 0;

            if ($name != "") {
                
                $animal = Atributos::find($id);
                    $animal->texto = $name;
                    $animal->active = $active;
                $animal->save();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAtributo($id_pregunta)
    {        

        $data = DB::table('atributos_animales as a')            
            ->select(
                'a.*'
            )
            ->where('id', $id_pregunta)
        ->get();
        return response()->json($data, 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAtributos()
    {
        $data = DB::table('atributos_animales as a')->select('a.*')->get();        

        return response()->json($data, 200);
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

        
        // $count += ContractDocuments::where('id_contract', $id)->count();

        if($count==0){
            
            Atributos::destroy($id);
            $this->logRegister(3, '', $id);
            return response()->json(null, 200);
        }else{
            return response()->json(null, 403);
        }
    }

    public function logRegister($event, $name, $id)
    {
        switch ($event) {
            case 1: $e = 'store';
                    $t = 'Question created, folio: '.$name;
                break;
            case 2: $e = 'update';
                    $t = 'Edited Question, folio: '.$name;
                break;
            case 3: $e = 'delete';
                    $t = 'Question deleted';                
                break;

        }
        Log::channel('contracts')->info('['.$e.']['.$t.']['.$id.']['.Auth::id().']');    
    }
}
