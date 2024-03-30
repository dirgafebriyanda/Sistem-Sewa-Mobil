@extends('layout.index')
@section('content')
    @auth
        @if (auth()->user()->role == 'User')
            <h1 class="h3 mb-4 text-gray-800">Selamat Datang, {{ auth()->user()->name }}</h1>
        @endif
    @endauth
@endsection
