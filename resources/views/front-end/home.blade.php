@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Money Exchanger</h2>
                </div>

                <div class="card-body">
                    <p class="text-center">Click <a href="{{ route('exchange.form') }}">here</a> to access the Money
                        Exchanger.</p>
                </div>

                <div class="card-footer text-center mt-3">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                    <p>New to our platform? <a href="{{ route('register') }}">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection