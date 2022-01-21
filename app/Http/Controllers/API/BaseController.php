<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

class BaseController extends Controller{
    /**
     * success response method
     * @param $result
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result,$message){
        $response = [
            'success'=>true,
            'data'=> $result,
            'message'=> $message,
        ];
        return response()->json($response,200);
    }
    public function sendError($error,$errorMessages = [],$code = 404){
        $response = [
            'success'=>false,
            'message'=>$error,
        ];
        if (!empty($errorMessages)){
            $response['error'] = $errorMessages;
        }
        return response()->json($response,$code);
    }
}
