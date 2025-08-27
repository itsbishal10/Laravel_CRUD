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

        public function login(Request $request){
        $incomingFields = $request ->validate([
            'login_name'=>'required',
            'login_password'=>'required',
        ]);
        if(Auth::attempt(['name' => $incomingFields['login_name'], 'password'=> $incomingFields['login_password']])){
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors(['login' => 'Invalid credentials.'])->withInput();
    }

    public function register(Request $request){
        $incomingFields= $request-> validate([
            'name'=>[ 'required','min:3', 'max:15', Rule::unique('users', 'name')],
            'email'=>[ 'required','min:5', 'max:15', Rule::unique('users', 'email')],
            'password'=>['required', 'min:6', 'max:150']
        ]);

        $incomingFields['password']= bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        Auth::login($user);
        return redirect('/');
     
    }
}
    