@extends('layouts.layout')

@section('title')
    @parent :: Вход в систему
@endsection

@section('content')
<div class="col-md-6 offset-md-3 mt-5">
    <h2 class="mb-4">Вход в систему</h2>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
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

    <form action="{{ route('login') }}" method="post">
        @csrf
        
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Войти</button>
    </form>

    <p class="mt-3">Нет аккаунта? <a href="{{ route('register.create') }}">Зарегистрироваться</a></p>
</div>
@endsection