<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('user.pages.connect')->with('pageTitle', 'Connexion');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'pseudo' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($request->only('pseudo', 'password'))){
            $request->session()->regenerate();
            return redirect()->intended('userDashboard');
        }

        // Auth::attempt(['email' => $email, 'password' => $password])

        return back()->withErrors([
            'email' => "Les informations de connexions sont incorrectes",
        ]);
    }

    public function logout(Request $request){

        if(auth()->user()->isBan == 1) {
            return redirect('/home')->withErrors(['message' => "Vous avez ete banni temporairement veuillez nous contacter"]);
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
