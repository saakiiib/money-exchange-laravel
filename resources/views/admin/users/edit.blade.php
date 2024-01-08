@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User Profile</h2>
    <form action="{{ route('admin.users.update', $user) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control" required>
                <option value="user" @if($user->role == 'user') selected @endif>User</option>
                <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User Profile</button>
    </form>
</div>
@endsection