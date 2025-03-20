<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(){
        return view("user.create");
    }
    public function store(Request $request){
        $request->validate([
            "name"=> ['required','max:255'],
            'email'=> ['required','email','max:255','unique:users'],
            'password'=> ['required']
        ]);

        User::create($request->all());

        return redirect()->route('login')->with('success','Вы успешно зарегестрировались');
    }

    public function login(){
        return view("user.login");
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password'=> ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success', 'Успешный вход');
        }

        return back()->withErrors([
            'email'=> 'Неправильный email'
        ]);
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('success','Вы вышли из аккаунта');
    }
}
