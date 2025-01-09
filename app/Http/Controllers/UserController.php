<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;



class UserController extends Controller
{
    public function index(Request $request){
        return Inertia::render('Home',[
            'users' => User::when($request->search, function ($query) use ($request){
                $query
                ->where('name', 'like', '%'. $request->search .'%')
                ->orwhere('email', 'like', '%'. $request->search .'%');
            })->paginate(10)->withQueryString(),
    
            'searchTerm'=> $request->search
        ]);
    }
}
