@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Users List</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>

                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('admin.users.confirm-delete', $user) }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection