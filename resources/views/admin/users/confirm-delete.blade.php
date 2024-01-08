@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Delete User</h2>
    <p>Are you sure you want to delete user: {{ $user->name }}?</p>
    <form action="{{ route('admin.users.delete', $user) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection