@extends('layouts.app')
@section('content')
<h1>Exchange Rates</h1>
@if ($exchangeRates)
<ul>
    @foreach ($exchangeRates as $currency => $rate)
    <li>{{ $currency }}: {{ $rate }}</li>
    @endforeach
</ul>
@else
<p>No exchange rates available.</p>
@endif
@endsection