<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $users = User::simplePaginate(10);

        return view('admin.users.index', compact('users'));
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:4',
    //     ]);

    //     $data['password'] = Hash::make($data['password']);
    //     $data['role'] = 'user';

    //     User::create($data);

    //     return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'user';

        $user = User::create($data);

        return response()->json($user);
    }
}
