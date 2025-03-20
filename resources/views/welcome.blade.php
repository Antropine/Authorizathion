@extends('layouts.main')

@section('title','Home page')

@section('content')
    <h1>Home page</h1>

    <!-- Вывод сообщений -->
    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
    @endif

@endsection

