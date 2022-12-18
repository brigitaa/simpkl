<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

class AuthlamaController extends Controller
{
    public function index()
    {
        return view('Login');
    }
    
    public function create()
    {
        $model = new User;
        return view('register', compact(
            'model'
        ));
    }

    public function store(Request $request)
    {
        $model = new User;
        $model->name = $request->nama;
        $model->username = $request->username;
        $model->password = $request->password;
        $model->save();
    }
}
