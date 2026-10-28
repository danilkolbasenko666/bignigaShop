@extends('layouts.layout')

@section('title')
    @parent :: Оформление заказа
@endsection 

@section('content')
    <div class="col-md-12">
        <h1>Оформление заказа</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 
        
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (!empty(session('cart')))
            <div class="table-responsive cart-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Фото</th>
                            <th>Наименование</th>
                            <th>Цена</th>
                            <th>Кол-во</th>
                            <th><i class="fas fa-times"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('products.show', ['slug' => $item['slug']]) }}">
                                        <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" width="80">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('products.show', ['slug' => $item['slug']]) }}">
                                        {{ $item['title'] }}
                                    </a>
                                </td>
                                <td>{{ number_format($item['price'], 0, '.', ' ') }} руб.</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>
                                    <span class="text-danger del-item" data-action="{{ route('cart.del_item', ['product_id' => $item['product_id']]) }}">
                                        <i class="fas fa-times"></i>
                                    </span>
                                </td>
                            </tr>
                        @endforeach 
                        
                        <tr>
                            <td colspan="3" align="right"><strong>Итого:</strong></td>
                            <td id="modal-cart-qty"><strong>{{ session('cart_qty') }}</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><strong>На сумму:</strong></td>
                            <td id="modal-cart-total"><strong>{{ number_format(session('cart_total'), 0, '.', ' ') }} руб.</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <form method="post" action="{{ route('cart.checkout') }}">
                @csrf 
                <div class="form-group">
                    <label for="name">ФИО</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="address">Адрес доставки</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="form-group">
                    <label for="note">Комментарий к заказу</label>
                    <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">Оформить заказ</button>
            </form>
        @else 
            <h4>Корзина пуста</h4>
        @endif
    </div>
@endsection