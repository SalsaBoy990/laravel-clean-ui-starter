@extends('public.layouts.public')

@section('content')

    <div class="welcome-content container relative">
        <h1 data-text="{{ config('app.name') }}" class="absolute middle center margin-0">{{ config('app.name') }}</h1>
    </div>

@endsection
