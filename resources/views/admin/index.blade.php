@extends('layouts.layout')

@section('title')
    @parent :: Админ-панель
@endsection

@section('content')
<div class="col-md-12 mt-4">
    <h1>Админ-панель</h1>
    <div class="alert alert-info">
        Добро пожаловать, {{ Auth::user()->name }}! Вы вошли как администратор.
    </div>
    <p>Здесь будет управление товарами, категориями и заказами.</p>
    <a href="{{ route('home') }}" class="btn btn-secondary">Вернуться на сайт</a>
</div>
@endsection