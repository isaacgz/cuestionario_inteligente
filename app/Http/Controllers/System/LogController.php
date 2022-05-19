<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;

class LogController extends Controller
{

     /**
     * @var string
     */
    private $diskName = 'logs';
    public $chars = array('local.INFO:', '[');

    public function index()
    {
        return view("system.log.log");        
    }


    public function getFiles($module)
    {      
        // dd($module);
        if($module!='' && $module>0)
            $files = Storage::disk($this->diskName)->files($this->dir($module));
        else 
            $files = '';
        return response()->json($files, 200);
    }

 
    public function getData(Request $request)
    {
        $fileName   = $request->json('fileName');
        $module = $request->json('module');   
        $filePath = $this->dir($module).'/'.$fileName;
        $exists = Storage::disk($this->diskName)->exists($filePath);
    
        if($exists){
            $data = array();
            $fp = fopen('../storage/logs/'.$filePath, "r");
            while (!feof($fp) == true){
                $row = fgets($fp);
                $row =  str_replace($this->chars, '', explode("]", $row));
                if(count($row)==6){
                    $date = trim($row[0]);
                    $event = trim($row[1]);
                    $message = trim($row[2]);
                    $id_event = trim($row[3]);
                    $user_event = $row[4]>0 ? getUserName(trim($row[4]))->name : '';
    
                    $item = array(
                        'date' => $date,
                        'event' => $event,
                        'message'  => $message, 
                        'id_event'  => $id_event, 
                        'user_event'  => $user_event
                    );
                    array_push($data, $item); 
                }
            }
            fclose($fp);
        }
        return response()->json($data, 200);
    }


    public function dir($module)
    {
        switch($module){
            case 1: $dir = 'auth';  break;
            case 2: $dir = 'activities/advance';  break;
            case 3: $dir = 'activities/legalization';  break;
            case 4: $dir = 'activities/compensation';  break;            
            case 5: $dir = 'cruds/users';  break;            
            case 6: $dir = 'cruds/roles';  break;            
            case 7: $dir = 'cruds/societies';  break;            
            default: $dir = ''; break;   
        }
      return $dir;  
    }

    

}
