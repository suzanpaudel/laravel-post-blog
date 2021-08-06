<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //validate
        $this->validate(
            $request,
            [
                'name' => 'required|max:30',
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]
        );

        //store user
        User::create([
            'name' => $request->name,
            'username' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        //sign user
        auth()->attempt($request->only('email', 'password'));

        //redirect
        return redirect()->route('dashboard');
    }
}
