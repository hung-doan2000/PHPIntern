<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
class LoginController extends BaseController
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
//            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['token'] =  auth()->user()->createToken('authToken')->accessToken;
            $success['name'] =  $user->name;
            return $this->sendResponse($success,'User login successfully!');
        }else{
            return $this->sendError('Unauthorised.',['error'=>'Unauthorised']);
        }
//        if (!auth()->attempt(['email'=>$request->email,'password'=>$request->password])) {
//            return response()->json(['message' => 'This User does not exist, check your details'], Response::HTTP_BAD_REQUEST);
//        }
//        $accessToken = auth()->user()->createToken('authToken')->accessToken;
//        return response()->json(['user' => auth()->user(), 'access_token' => $accessToken,'message' => 'login success'],Response::HTTP_OK);
    }
}
