<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MyUsersController extends Controller
{
     public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
