<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email:filter',
            'password'=>'required'
        ]);
        if (Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
        ],$request->input('remember'))){
            return redirect()->route('admin.dashboard');
        }
        Session::flash('error','Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }
}
