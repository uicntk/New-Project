<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){

        
        $save = $request->validate([
            'name' => ['required', 'max:255'],
            'avatar' => ['file', 'nullable', 'max:1000'],
            'phone' => ['required'],
            'email' => ['required', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        if ($request->hasFile('avatar')){
            $save['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        $user = User::create($save);
        Auth::login($user);
        
        return redirect('/')->with('message', 'Welcome to the Jungle');
    }

    public function login(Request $request){
        /**
     * Handle an authentication attempt.
     */
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
 
            return redirect('/');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
        sleep(1);
        return redirect('/login');
    }
}
