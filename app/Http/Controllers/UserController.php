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

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.list')->with('success', 'User profile updated successfully.');
    }
    public function confirmDelete(User $user)
    {
        return view('admin.users.confirm-delete', compact('user'));
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.list')->with('success', 'User deleted successfully.');
    }

    public function list()
    {
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }
}
