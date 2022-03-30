<?php
/**
 * Created by Arajan Nandaniya.
 * Email: arjann006@gmail.com
 */

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait ApiResponseTrait
{
    public static function AllResponse($statusText='Error', $status=Response::HTTP_BAD_REQUEST, $ok=false, $message="",  $data=null, $url=''){
        return response()->json([
            'status'=> $status==200?true:false,
            'status_code' => $status,
            'message'=>$message,
        ]);
    }

    public static function UnauthenticatedResponse(): \Illuminate\Http\JsonResponse
    {

        return response()->json([
            'status'=>false,
            'status_code'=>Response::HTTP_UNAUTHORIZED,
            'message'=>'You Are Unauthenticated. Login Again',
        ],Response::HTTP_UNAUTHORIZED);
    }

    public static function CollectionResponse($statusText='Success', $status=200, $collection=null, $message=null){
        return $collection->additional(
            [
                'status'=> $status==200?true:false,
                'status_code' => $status,
                'message'=>$message==null?'':$message,
            ]);
    }

    public static function SingleResponse($data, $statusText='Success', $status=200, $ok = true, $message=''){
        return response()->json([
            'status'=> $status==200?true:false,
            'status_code' => $status,
            'data'=>$data,
            'message'=>$message==null?'':$message
        ]);
    }

    public static function ValidationResponse($errors=[], $statusText='Validation', $status=Response::HTTP_NOT_ACCEPTABLE, $ok=false)
    {
        $message = null;
        foreach ($errors as $error){
            if(!empty($error)){
                foreach ($error as $errorItem){
                    $message .=  $errorItem .',';
                }
            }
        }
        return response()->json([
            'status' => false,
            'status_code'=>Response::HTTP_NOT_ACCEPTABLE,
            'message'=>$message,
        ]);
    }

    public static function MakeCollectionResponse(Request $request, $list)
    {

        if (!empty($request->per_page)) {
            $list = $list->paginate($request->per_page);
        }elseif (!empty($request->page)){
            $list = $list->paginate();
        }elseif(!empty($request->take)){
            $list = $list->take($request->take)->get();
        }else{
            $list = $list->get();
        }
        return $list;
    }

    public static function EmptyResponse($statusText='Error', $status=Response::HTTP_BAD_REQUEST, $ok=false, $message="",  $data=null, $url=''){

        return response()->json([
            'status'=> $status==200?true:false,
            'status_code' => $status,
            'message'=>'Record not found !',
            'data'=>[],
        ]);
    }
}
