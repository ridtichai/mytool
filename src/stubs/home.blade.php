@extends('layouts.index')
@section('content')

    <h1>Home</h1>

    @if (is_null(Auth::user()))
        <a href="{{ route('login') }}">Login</a>
    @else
        <a href="{{ route('logout') }}">Logout</a>
    @endif

@endsection

@push('css')
@endpush

@push('scripts')
@endpush

@section('title', 'home')
