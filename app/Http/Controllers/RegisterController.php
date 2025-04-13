<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User as RequestsUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user.registration');
    }

    public function store(RequestsUser $request)
    {
        $validated = $request->validated();
        $result = User::insertGetId([
            'first_name' => $validated['first_name']??"",
            'last_name' => $validated['last_name']??"",
            'contact' => $validated['contact']??"",
            'email' => $validated['email']??"",
            'company_name' => $validated['co_name']??"",
            'gst_no' => $validated['gst_no']??"",
            'address_1' => $validated['address_1']??"",
            'address_2' => $validated['address_2']??"",
            'city' => $validated['city']??"",
            'state' => $validated['state']??""
        ]);
        if(Auth::loginUsingId($result)){
            $data = User::find($result);
            session([
                'role'=>"user",
                'user'=>$data->first_name,
                'email'=>$data->email,
                'contact'=>$data->contact,
                'id'=>$data->id,
                'company_name' => $data->co_name,
                'gst_no' => $data->gst_no,
                'address_1' => $data->address_1,
                'address_2' => $data->address_2,
                'city' => $data->city,
                'state' => $data->state,
            ]);
            return redirect('home');
        }else{
            return redirect()->back()   ;
        }
    }
}
