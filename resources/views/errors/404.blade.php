@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Not Found') }}</div>
                <div class="card-body">
                    <p>The page you are looking for does not exist.</p>
                    <a href="{{ url('/') }}">Return to Home Page</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection