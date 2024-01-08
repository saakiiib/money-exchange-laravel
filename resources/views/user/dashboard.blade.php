@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                    <p>This is your dashboard. Add your content here.</p>
                </div>
                <div class="card-body">
                    <a href="{{ route('edit-profile.edit') }}" class="btn btn-link">Edit Profile</a>
                </div>

                <div class="card-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection