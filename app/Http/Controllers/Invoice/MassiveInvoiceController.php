<?php

namespace App\Http\Controllers\Invoice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advance;
use GuzzleHttp\Client;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MassiveInvoiceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Ver_FacturasMasiva|Crear_FacturasMasiva|Editar_FacturasMasiva|Eliminar_FacturasMasiva',['only' => ['index']]);
        $this->middleware('permission:Crear_FacturasMasiva',['only' => ['create', 'store']]);
        $this->middleware('permission:Editar_FacturasMasiva',['only' => ['edit', 'update']]);
        $this->middleware('permission:Eliminar_FacturasMasiva',['only' => ['destroy']]);
    }
    /**
     * Display register user list view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {                      
        return view('admin.invoice.masive.report');
    }
    
    public function store(Request $request)
    {
        try {
            // dd($request);
            DB::beginTransaction();   
            $id_usuario = Auth::user()->id;         
            $id_society = $request->json('id_society');
            $account_employee = $request->json('account_employee');
            $document_date = $request->json('doc_date');
            $cont_date = $request->json('cont_date');
            $reference = $request->json('reference');
            $amount = $request->json('amount');
            $id_currency = $request->json('id_currency');
            $header_text = $request->json('header_text');
            $payment_method = $request->json('payment_method');
            $text = $request->json('text');
            #La fecha de expiracion es la misma que la fecha de contabilización
            $expiration_date = $request->json('cont_date');
            $errors = 0;

            $indicadorCME = 'E';
            $bloqueo_pago = 'A';


            if ($account_employee != "" 
                && $document_date != "" 
                && $cont_date != ""
                && $id_society != ""
                && $id_currency != ""
                && $reference != ""
                && $header_text != ""
                && $amount != ""
                && $payment_method != ""
                ) {
                    
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

    public function store_advance(Request $request)
    {
        try {
            // dd($request);
            DB::beginTransaction();   
            $id_usuario = Auth::user()->id;         
            $id_advance = $request->json('id_advance');
            $errors = 0;            
            $resp = "";
            $idAnticipo = "";
            $valido     = false;
            $error      = "";

            if ($id_advance != "") {

                
                
            }else{
                $errors++;
            }

            if($errors==0){   
                DB::commit();                
                if ($valido == true) {  
                    // $this->logRegister(4, trim($request->json('reference')), $id_advance);                 
                    return response()->json($resp, 200);
                }else{
                    // if ($advance[0]->levels == $advance[0]->levels_society) {                            
                    //     return response()->json($resp, 422);
                    // }else{
                    //     // $this->logRegister(4, trim($request->json('reference')), $id_advance);                 
                    //     return response()->json($resp, 200);
                    // }
                }
            }else{
                DB::rollback();
                return response()->json($resp, 422);
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
    }

    public function cancel_advance(Request $request)
    {
        $id_advance = $request->json('id_advance');
        $text_deny   = $request->json('text_deny');
        $id_user = Auth::user()->id;
        $id_society = Auth::user()->id_society;

        try {
            DB::beginTransaction();  
            $errors = 0;

            if ($text_deny != "") {                

                $advance_det = DB::table('advance_approval_levels as a')->select('a.*')->where('id_advance', $id_advance)->where('decision',0)->first();

                DB::table('advance_approval_levels')->where('id', $advance_det->id)->update(['id_user' => $id_user,'decision' => 2, 'text_deny' => $text_deny]);

                $advance = DB::table('advance as a')->select('a.*',
                    DB::raw("(SELECT COUNT(b.id) FROM advance_approval_levels as b WHERE b.id_advance=a.id and decision!=0) as levels_society"),
                    DB::raw("(SELECT levels FROM society WHERE society.id=a.id_sociedad) as levels"),
                    DB::raw("(SELECT id FROM society WHERE society.id=a.id_sociedad) as id_society"))
                    ->where('id', $id_advance)->get();

                if ($advance[0]->levels == $advance[0]->levels_society) {
                    DB::table('advance')->where('id', $id_advance)->update(['estatus' => 3]);
                }

            }else{
                $errors++;
            }
            
            if ($errors==0) {
                DB::commit();
                $this->logRegister(5, '', $id_advance);
                return response()->json(null, 200);
            }else{
                DB::rollback();
                return response()->json('Error al denegar Facturas_Clientes:', 422);
            }
            
        }    
        catch (\Exception $e) {
            DB::rollback();
            return response()->json('Error al denegar Facturas_Clientes:'.$e, 422);
        }
    }
    
    public function getSocieties()
    {
        $societies = DB::table('society')
            ->where('active', 1)
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json($societies, 200);
    }

    public function getAdvances(Request $request)
    {        
        $startDay   = $request->json('startDay');        
        $endDay     = $request->json('endDay');        
        $id_society = $request->json('id_society');        
        $reference  = trim($request->json('reference'));
        $active     = $request->json('active');
        $id_usuario = Auth::user()->id;
        $id_role_user = Auth::user()->id_role;
        $id_society_emp = Auth::user()->id_society;
        
        $art = DB::table('advance as a')
            ->select(
                'a.id',
                'a.id_usuario',
                'a.referencia',
                'a.importe',
                'a.estatus',
                'a.texto',
                'a.error',
                DB::raw("(SELECT " . $id_role_user ." ) as id_role_user"),
                DB::raw("convert(varchar, a.fechadoc, 105) as fechadoc"),
                DB::raw("(SELECT COUNT(b.id) FROM advance_approval_levels as b WHERE b.id_advance=a.id and decision!=0) as levels_society"),
                DB::raw("(SELECT levels FROM society WHERE society.id=a.id_sociedad) as levels"),
                DB::raw("(SELECT name FROM society WHERE society.id=a.id_sociedad) as sociedad"),
                DB::raw("(SELECT id_role FROM sys_users WHERE sys_users.id=a.id_usuario) as id_role")
            );

        /** search by date*/
        if ($startDay != "" && $endDay != "") {
            $art = $art->whereBetween('a.fechadoc', [$startDay, $endDay]);            
        }

        /** search by id_usuario*/
        if ($id_role_user != 1) {                      
            $art = $art->where('a.id_usuario', '=', $id_usuario);
        }

        /** search by idSociety*/
        if ($id_role_user != 1) {
            if ($id_society_emp > 0) {
                $art = $art->where('a.id_sociedad', $id_society_emp);
            }
        }else if($id_society != ""){
            $art = $art->where('a.id_sociedad', $id_society);                
        }
        

        /**  status */
        if ($active >= 0 && $reference == '')
            $art = $art->where('a.estatus', $active);

        /** search by reference*/
        if ($reference != '') {
            $art = $art->where('a.referencia', 'like', '%' . $reference . '%');
        }

        

        $data = $art->orderBy('a.id', 'asc')->get();        

        return response()->json($data, 200);
    }

    public function getAdvancesDetails($id_advance)
    {
        $data = DB::table('advance as a')->select(
            'a.id',            
            'a.referencia',
            'a.textocab',
            'a.cuenta',
            'a.cmeindicator',
            'a.importe',
            'a.bloqueo_pago',
            'a.via_pago',
            'a.texto',
            'a.error',
            'a.valido',
            'a.id_Anticipo',
            'a.estatus',
            DB::raw("CASE moneda WHEN 1 THEN 'COP' WHEN 2 THEN 'USD' ELSE '' END as moneda_txt"),
            DB::raw("(SELECT name FROM sys_users WHERE sys_users.id=a.id_usuario) as nombre"),
            DB::raw("(SELECT name FROM society WHERE society.id=a.id_sociedad) as sociedad"),
            DB::raw("convert(varchar, a.fechadoc, 105) as fechadoc"),
            DB::raw("convert(varchar, a.fecha_contabilizacion, 105) as fecha_contabilizacion"),
            DB::raw("convert(varchar, a.fecha_vencimiento, 105) as fecha_vencimiento")            
        )->where('id', $id_advance)->get();        

        return response()->json($data, 200);
    }

    public function destroy(Request $request)
    {
        $id = $request->json('id');

        try {
            DB::beginTransaction();                        
            DB::table('advance')->where('id', $id)->delete();
            DB::commit();
            $this->logRegister(3, '', $id);
            return response()->json(null, 200);
        }    
        catch (\Exception $e) {
            DB::rollback();
            return response()->json('Error al eliminar orden:'.$e, 422);
        }
    }

    public function logRegister($event, $name, $id){

        switch ($event) {
            case 1: $e = 'store';
                    $t = 'Resource created, reference: '.$name;
                break;
            case 2: $e = 'update';
                    $t = 'Edited resource, reference: '.$name;
                break;
            case 3: $e = 'delete';
                    $t = 'Resource deleted';
                break; 
            case 4: $e = 'accepted';
                    $t = 'Advance accepted id:'.$id;
            break;   
            case 5: $e = 'canceled';
                    $t = 'Advance canceled id:'.$id;
            break;   
        }
        Log::channel('adv_soli')->info('['.$e.']['.$t.']['.$id.']['.Auth::id().']');    
    }
}
