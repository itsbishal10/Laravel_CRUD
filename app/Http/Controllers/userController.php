<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class userController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

        public function login(){
        Auth::login();
        return redirect('/');
    }

    public function register(Request $request){
        $incomingFields= $request-> validate([
            'name'=>[ 'required','min:3', 'max:15', Rule::unique('users', 'name')],
            'email'=>[ 'required','min:5', 'max:15', Rule::unique('users', 'email')],
            'password'=>['required', 'min:6', 'max:150']
        ]);

        $incomingFields['password']= bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth::login($user);
        return redirect('/');
     
    }
}
    