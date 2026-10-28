function showCart(cart) {
    $('#cart-modal .modal-body').html(cart);
    $('#cart-modal').modal();
    
    let cartQty = $('#modal-cart-qty').text() ? $('#modal-cart-qty').text() : 0;
    $('.mini-cart-qty').text(cartQty);
    
    if (cartQty) {
        $('#cart-modal .modal-footer button.btn-cart').removeClass('d-none');
    } else {
        $('#cart-modal .modal-footer button.btn-cart').addClass('d-none');
    }
}

function getCart(action) {
    $.ajax({
        url: action,
        type: 'get',
        success: function(result) {
            showCart(result);
        },
        error: function() {
            alert('Error!');
        }
    });
}

function clearCart(action) {
    $.ajax({
        url: action,
        type: 'get',
        success: function(result) {
            let nowLocation = document.location.pathname;
            if (nowLocation == '/cart/checkout') {
                location = '/cart/checkout';
            } else {
                showCart(result);
            }
        },
        error: function() {
            alert('Error!');
        }
    });
}

$(function () {
    // Удаление товара из корзины
    $('#cart-modal .modal-body, .cart-table').on('click', '.del-item', function() {
        $.ajax({
            url: $(this).data('action'),
            type: 'get',
            success: function(result) {
                let nowLocation = document.location.pathname;
                if (nowLocation == '/cart/checkout') {
                    location = '/cart/checkout';
                } else {
                    showCart(result);
                }
            },
            error: function(msg) {
                alert('Error!');
            }
        });
    });

    $('.addtocart').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            dataType: 'html',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (result) {
                showCart(result);
            },
            error: function (xhr) {
                console.log('ERROR:', xhr.responseText);
                alert('Ошибка при добавлении товара!');
            }
        });
    });
});