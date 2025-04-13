<?php

namespace App\Http\Controllers;

use App\Mail\otpMailer;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;

class OtpMailerController extends Controller
{
    public function sendOtp(Request $request){
        $email = $request->email;
        $validEmail = User::where(['email'=>$email])->count();
        if($validEmail == 1){
            if(!Mail::to($email)->send(new otpMailer)){
                return redirect('login');
            }else{
                return redirect('otpVerify')->with(['email'=>$email]);
            }
        }else{
            return redirect('register')->withInput(['email'=>$email]);
        }
    }
    public function verification(){
        return view('otpVerification')->with(['email'=>session('email')]);
    }

    public function verify(Request $request){
        $validated = Validator::make($request->all(),[
            'otp' => 'required|numeric|digits:6'
        ]);
        if($validated->fails()){
            return response()->json(['errors'=>$validated->getMessageBag()->toArray()]);
        }else{
            $otp = Otp::orderByDESC('id')->first();
            if((string)$otp->otp == $request->otp && !empty($otp)){
                $now = now();
                if($now->diffInSeconds($otp->created_at) < 120){
                    $data = User::where('email',$request->email)->get();
                    $data = isset($data[0])?$data[0]:[];
                    if(Auth::loginUsingId($data->id)){
                        return response()->json(['success' => 'Otp Verified']);
                    }else{
                        return response()->json(['errors' => 'something went wrong']);
                    }
                }else{
                    return response()->json(['errors' => 'otp expired']);
                }
            }else{
                return response()->json(['errors'=> 'Incorrect Otp']);
            }
        }
    }
    public function resendOtp(Request $request){
        $email = $request->email;
        $validEmail = User::where(['email'=>$email])->count();
        if($validEmail > 0 && $validEmail < 2){
            if(!Mail::to($email)->send(new otpMailer)){
                return redirect('login');
            }else{
                return response()->json(['success' => 'sent']);
            }
        }else{
            return response()->json(['errors' => 'invalid email']);
        }
    }
}
