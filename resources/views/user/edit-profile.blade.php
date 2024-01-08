@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    <form action="{{ route('edit-profile.update') }}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection