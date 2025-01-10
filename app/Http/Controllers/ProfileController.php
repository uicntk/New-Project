<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile(Request $request){
        return Inertia::render('Profile',[
            'user' => $request->user()
        ] );
    }

    public function edit(Request $request){
        $save = $request->validate([
            'name' => ['required', 'max:255'],
            'phone' => ['nullable', 'max:255'],
            'email' => ['required', 'max:255', 'email', 
                        Rule::unique(user::class)->ignore($request->user()->id)],
            'avatar' => ['file', 'nullable', 'max:1000']
        ]);

        
        if ($request->hasFile('avatar')){
            $save['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }
        
        $save = User::find($request->id)->update($save);


        return redirect('/profile');
    }

    public function editpass(Request $request){
        $save = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:3']
        ]);
        
        $save = User::find($request->id)->update([
            'password' => Hash::make($save['password'])
        ]);
        

        return redirect('/profile')->with('message', 'Your Password has Changed!');
    }
}
