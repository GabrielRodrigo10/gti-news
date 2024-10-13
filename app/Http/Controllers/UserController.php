<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15); //User::all();
        
        return view('admin.index', compact('users'));
    }

    public function create () {
        return view('admin.create');
    }

    public function store (Request $request) {

        User::create($request->all());
        
        return redirect()->route('users.index');
    }
}
