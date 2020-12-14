<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user=User::create($request->validated());

        if (Auth::attempt(['email'=>$request->email,'password'=>$request->get('password'),]))
            return redirect()->route('index');
        else
            return redirect()->back();
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email'=>$request->get('email'),'password'=>$request->get('password'),]))
            return redirect()->route('tasks.index');//TODO: redirect to dashbord
        else
            return redirect()->back()->with('error','ایمیل یا رمز عبور وارد شده صحیح نیست');
    }

    public function logout()
    {
        if
            (auth()->check());
            auth()->logout();

        return redirect()->route('login');
    }
}
