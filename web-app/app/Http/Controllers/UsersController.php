<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class UsersController extends Controller
{
    function login(Request $req){
        if ($req->isMethod('post')) {

            // validation
            $body = $req->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            // end

            if (Auth::attempt($body)) {
                $req->session()->regenerate();
    
                return redirect()->intended('dashboard');
            }

            return back()->withErrors([
                'email' => 'username or password does not match.',
            ]);
            
        }
        return view('Pages/Users/login');
    }
    
    function signup(Request $req){
        if ($req->isMethod('post')) {

            // validation
            $validated = $req->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'confirm_password' => 'required',
                'address' => 'required',
            ]);
            // end

            $body = $req->all();
            $body['password'] = Hash::make($body['password']);
            $user = User::create($body);
            return redirect()->route('login');
        }
        return view('Pages/Users/signup');
    }

    function changePassword(Request $req){
    
        return view('Pages/Users/change-password');

    }


    function passwordChange(Request $req){

        return view('passwordChange');
        $req->validate([
            'current_password'  => ['required',new Password],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],

        ]);

        User::find(auth()->user()->id )->update(['password' =>Hash::make($req->new_password)]);





    }


    function forgetPasssword(Request $req){

        
    }

    function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('login');
    }

}
