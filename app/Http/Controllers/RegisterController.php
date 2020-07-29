<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $create = \App\User::create($input);
        if($create) {
            return redirect('/login')->with('status','success');
        } else {
            return redirect()->back();
        }
    }
}
