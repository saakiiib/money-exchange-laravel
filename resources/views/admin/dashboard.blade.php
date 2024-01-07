@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Admin Dashboard') }}</div>

            <div class="card-body">
                <p>Welcome to the Admin Dashboard, {{ Auth::user()->name }}!</p>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection