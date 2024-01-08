@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <p>Welcome to the Admin Dashboard, {{ Auth::user()->name }}!</p>
                    <div class="dashboard-links">
                        <a href="{{ route('admin.exchangeRates') }}" class="btn btn-primary">Exchange Rates</a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-success">Manage Users</a>
                    </div>
                </div>

                <div class="card-footer">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection