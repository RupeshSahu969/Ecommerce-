<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Validator;

use App\Traits\Message;
use Illuminate\Support\Facades\Auth;

// jwt
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
class UsersController extends Controller
{
    use Message;

    function registerUser(Request $request){

        $post = $request->all();
        $validator =  Validator::make($post, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()){
            
           // return $this->error("Validation error", $validator->messages()->toArray(), 422);
        }

        $body = $request->all();
        $body['password'] = Hash::make($body['password']);
        $user = User::create($body);

        return [
            'user'=> $user
        ];
    }

    function userLogin(Request $request){
        $post = $request->all();
        $validator =  Validator::make($post, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
           // return $this->error("Validation error", $validator->messages()->toArray(), 422);
        }

        $user = User::where(['email'=>$post['email']])->first();
        $credentials = $request->only('email', 'password');

        if (!$user || !Auth::attempt($credentials)) {
            return $this->error('Unauthorized', [["Invalid username or password"]], 401);
        }

        // jwt token generation
        $payload = [
            'iss'=>'laravel-app', 
            'data'=> $user, 
            'iat'=> time(), 
            'exp'=> time() + 7 * 24 * 60 * 60
        ];
        // end
        $token = JWT::encode($payload, env('JWT_KEY'));
        $user = $user->toArray();
        $user['token'] = $token;
        return $this->success('User logged in successfully!', $user, 200);
    }  


}
