@extends('layouts.layout')

@section('title')
    @parent :: Регистрация
@endsection

@section('content')
<div class="col-md-6 offset-md-3 mt-5">
    <h2 class="mb-4">Регистрация</h2>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.store') }}" method="post">
        @csrf
        
        <div class="form-group mb-3">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
    </form>

    <p class="mt-3">Уже есть аккаунт? <a href="{{ route('login.create') }}">Войти</a></p>
</div>
@endsection