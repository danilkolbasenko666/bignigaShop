@if(!empty(session('cart')))
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">фото</th>
                    <th scope="col">наименование</th>
                    <th scope="col">цена</th>
                    <th scope="col">кол-во</th>
                    <th><i class="fas fa-times"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $item)
                <tr>
                    <td>
                        <a href="{{ route('products.show', ['slug' => $item['slug']]) }}">
                            <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}">
                        </a>
                    </td>
                    <td><a href="{{ route('products.show', ['slug' => $item['slug']]) }}">{{ $item['title'] }}</a></td>
                    <td>{{ number_format($item['price'], 0, '.', ' ') }} руб.</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>
                        <span class="text-danger del-item" data-action="{{ route('cart.del_item', ['product_id' => $item['id']]) }}">
                            <i class="fas fa-times"></i>
                        </span>
                    </td>
                </tr>
                @endforeach 
                <tr>
                    <td colspan="3" align="right">итого:</td>
                    <td id="modal-cart-qty">{{ session('cart_qty') }}</td>
                </tr>
                <tr>
                    <td colspan="3" align="right">на сумму:</td>
                    <td id="modal-cart-total">{{ number_format(session('cart_total'), 0, '.', ' ') }} руб.</td>
                </tr>
            </tbody>
        </table>
    </div>
@else 
    <h4>корзина пуста</h4>
@endif
