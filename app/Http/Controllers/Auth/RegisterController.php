<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function register(UserRequest $request){
        try {
            $dataUser = [
                'name'=> $request->input('name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ];
            $user = User::create($dataUser);
            $emailJob = new SendWelcomeEmail($user);
            dispatch($emailJob->delay(10));
            Session::flash('success','Create account success');
        }catch (\Exception $err){
            Session::flash('error','Create account fail');
            \Log::info($err->getMessage());
        }
        return redirect->back();
    }
}
