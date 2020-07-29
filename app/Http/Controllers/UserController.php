<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $create = \App\User::create($input);
        if($create) {
            return redirect()->back()->with();
        } else {
            return redirect()->back()->with();
        }
    }
}
