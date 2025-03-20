<!-- resources/views/dashboard.blade.php -->

@extends('layouts.main')

@section('title', 'Дашборд')

@section('content')
    <div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Добро пожаловать!</h5>
        <div class="alert alert-success mb-3">
            Успешный вход
        </div>
        <p class="card-text">Вы успешно вошли в систему.</p>

        <!-- Кнопка "Выйти" -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf <!-- CSRF-токен -->
                <button type="submit" class="btn btn-danger">Выйти</button>
        </form>

    </div>
</div>
@endsection

@section('styles')
    <!-- Дополнительные стили для dashboard -->
@endsection

@section('scripts')
    <!-- Дополнительные скрипты для dashboard -->
@endsection