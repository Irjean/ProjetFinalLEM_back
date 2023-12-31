<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Allow a user to log in
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)) {
            return response()->json([
                "status" => "ok"
            ], 200);
        } else {
            return response()->json([
                "status" => "Les identifiants ne correspondent pas."
            ], 403);
        }
    }
}
