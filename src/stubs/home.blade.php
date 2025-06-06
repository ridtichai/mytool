@extends('layouts.index')
@section('content')

    <h1>Home</h1>

    <a href="{{ route('login') }}">Login</a>

@endsection

@push('css')
@endpush

@push('scripts')
@endpush

@section('title', 'home')
