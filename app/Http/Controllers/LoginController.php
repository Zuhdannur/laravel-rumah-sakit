<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password])) {
            return redirect()->intended('/');
        }

        return redirect()->back();
    }

    public function logout() {
        if(Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        return redirect('/');
    }


}
