<?php

namespace App\Http\Controllers;

use App\Mail\LoginMail;
use App\Mail\WellcomeMail;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Exists;
use Psy\CodeCleaner\IssetPass;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name'=>'required|string||max:155',
            'last_name'=>'required|string||max:155',
            'password'=>'required|string|max:25|min:8|confirmed',
            'email'=>'required|string|max:255|unique:users,email',
        ]);

        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        Mail::to($user->email)->send(new WellcomeMail($user));


        return redirect('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password'=>'required|string|max:25|min:8',
            'email'=>'required|string|max:255',
        ]);

        if(!Auth::attempt($request->only('email','password')))
            return redirect('login')->with('error','Wrong password or email');
        
        $user = User::where('email',$request->email)->firstOrFail();

        $token = $user->createToken('auth_Token')->plainTextToken;
        Mail::to($user->email)->send(new LoginMail($user));


        if(isset($token)){
            if(Profile::where('user_id',$user->id)->exists()){
                return redirect()->route('profile.get',$user->id);
            }
            return redirect('profile');
        }


        return response()->json(['message'=>'user loged in','user'=>$user,'Token'=>$token],201);
    }
    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('login')->with('erorr','User Loged Out Successfully');
    }
}
