<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('user.login');
    }
    public function logout(Request $request){
        Auth::logout();
        Session::forget('id');
        Session::forget('role');
        Session::forget('user');
        Session::forget('email');
        Session::forget('company_name');
        Session::forget('gst_no');
        Session::forget('address_1');
        Session::forget('address_2');
        Session::forget('city');
        Session::forget('state');
        return redirect()->back();
    }
}
