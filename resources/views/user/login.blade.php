@extends('layouts.main')

@section('title','Home page')

@section('content')

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Войти в аккаунт</h1>

            <form action="{{ route('login.auth') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="password">
                </div>

                <button type="submit" class="btn btn-primary mb-2">Войти</button>

                <!-- Кнопка для входа через Google-->
                <a href="http://localhost:8000/auth/google/redirect" class="btn btn-dark w-100 mb-2">
                    <i class="fab fa-github"></i> Войти через Google
                </a>

                <!-- Кнопка для входа через GitHub -->
                <a href="http://localhost:8000/auth/github/redirect" class="btn btn-dark w-100 mb-2">
                    <i class="fab fa-github"></i> Войти через GitHub
                </a>

            </form>
        </div>
    </div>

@endsection

