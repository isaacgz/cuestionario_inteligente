<?php

namespace App\Http\Controllers;

use App\Models\Preguntas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PreguntasController extends Controller
{
    /**
     * Display register user list view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {              
        
        return view('system.preguntas.report');
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

            if ($text != "" && $active != "" ) {
                DB::table('preguntas')->insert([                
                    'texto'  => $text,
                    'status'   => $active,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPregunta($id_pregunta)
    {        

        $data = DB::table('preguntas as a')            
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
    public function getPreguntas()
    {
        $data = DB::table('preguntas as a')->select('a.*')->get();        

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
            
            Preguntas::destroy($id);
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
