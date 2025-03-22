@extends('layouts.main')

@section('title','Home page')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Регистрация</h1>

            <form action="{{ route('user.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="password">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        Уже есть аккаунт?
                    </a>
                </div>

            </form>
        </div>
    </div>

@endsection

