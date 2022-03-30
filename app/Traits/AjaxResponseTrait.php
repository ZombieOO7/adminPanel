<?php
/**
 * Created by Arajan Nandaniya.
 * Email: arjann006@gmail.com
 */

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait AjaxResponseTrait
{
    public static function AllResponse($status=false,$icon='info',$message="", $data=null, $url=''){
        return response()->json([
            'status'=> $status==200?true:false,
            'status_code' => $status,
            'message'=>$message,
            'icon' =>$icon,
            'url' => $url,
        ]);
    }

    public static function RedirectResponse($status,$route=null,$message="",$id=null){
        if($id != null){
            return redirect()->route($route,['uuid'=>@$id])->with($status,$message);
        }
        return redirect()->route($route)->with($status,$message);
    }
}