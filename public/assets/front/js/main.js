function showCart(cart) {
    $('#cart-modal .modal-body').html(cart);
    $('#cart-modal').modal();
    
    let cartQty = $('#modal-cart-qty').text() ? $('#modal-cart-qty').text() : 0;
    $('.mini-cart-qty').text(cartQty);

    if (cartQty > 0) {
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
            alert('Error');
        }
    });
}

function clearCart(action) {
    $.ajax({
        url: action,
        type: 'get',
        success: function(result) {
            showCart(result);
        },
        error: function() {
            alert('Ошибка при очистке корзины');
        }
    });
}

$(function() {
    $('.add-to-cart, .addtocart').on('submit', function() {
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: 'post',
            success: function(result) {
                showCart(result);
                form[0].reset(); 
            },
            error: function(msg) {
                alert('Ошибка!');
                console.log(msg.responseJSON);
            }
        });
        return false;
    });

    $('#cart-modal .modal-body').on('click', '.del-item', function() {
        let action = $(this).data('action');
        $.ajax({
            url: action,
            type: 'get',
            success: function(result) {
                showCart(result);
            },
            error: function(msg) {
                alert('Ошибка при удалении!');
                console.log(msg.responseJSON);
            }
        });
    });
});