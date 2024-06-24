$(document).ready(function() {
    $('.js-cart-touchspin').click(function() {
        var button = $(this);
        var input = button.closest('.quantity').find('.quantity-input');
        var id = button.closest('.cart-item').data('id');
        var newQuantity = parseInt(input.val());
    
        if (button.hasClass('cart-touchspin-up')) {
            newQuantity++;
        } else if (button.hasClass('cart-touchspin-down') && newQuantity > 1) {
            newQuantity--;
        }
    
        input.val(newQuantity);
    
        $.ajax({
            url: 'http://127.0.0.1:8000/cart/update',
            method: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: newQuantity
            },
            success: function(response) {
                if(response.success) {
                    var cartItem = button.closest('.cart-item');
                    var totalPrice = newQuantity * response.cart[id].sale;
                    cartItem.find('.product-price').text(totalPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                    $('.subtotal').text(response.subtotal.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }) + ' VND');
                    $('.total').text(response.total.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }) + ' VND');
                }
            }
        });
    });
    
    $('.remove-from-cart').click(function() {
        var id = $(this).data('id-product');
        var button = $(this);
    
        $.ajax({
            url: 'http://127.0.0.1:8000/cart/remove',
            method: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function(response) {
                if(response.success) {
                    // Xóa sản phẩm khỏi giao diện người dùng
                    button.closest('.cart-item').remove();
                    // Cập nhật lại tổng tiền và các thông số khác
                    $('.subtotal').text(response.subtotal.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                    $('.total').text(response.total.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                    // Hiển thị thông báo thành công hoặc thất bại (nếu cần)
                }
            }
        });
    });
    $('.bootstrap-touchspin-up').click(function() {
        var currentVal = parseInt($('#quantity').val());
        $('#quantity').val(currentVal + 1);
    });

    $('.bootstrap-touchspin-down').click(function() {
        var currentVal = parseInt($('#quantity').val());
        if (currentVal > 1) {
            $('#quantity').val(currentVal - 1);
        }
    });
    // Kiểm tra giá trị đầu vào khi thay đổi
    $('#quantity').on('input', function() {
        var currentVal = $(this).val();
        // Loại bỏ tất cả các ký tự không phải là số
        currentVal = currentVal.replace(/[^0-9]/g, '');
        $(this).val(currentVal);
    });

    // Kiểm tra giá trị đầu vào khi mất tiêu điểm (blur event)
    $('#quantity').on('blur', function() {
        var currentVal = parseInt($(this).val());
        if (isNaN(currentVal) || currentVal < 1) {
            $(this).val(1);
        }
    });

    // Tải giỏ hàng khi trang được tải

    // Thêm sản phẩm vào giỏ hàng
    $('#add-product-form').on('submit', function(e) {
        e.preventDefault();

        var id = $('#id').val();
        var quantity = $('#quantity').val();
        var title = $('#title').val();
        var price = $('#price').val();
        var sale = $('#sale').val();
        var image = $('#image').val();

        $.ajax({
            url: "http://127.0.0.1:8000/cart/add",
            method: 'POST',
            data: {
                id: id,
                quantity: quantity,
                title: title,
                price: price,
                sale: sale,
                image: image,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                alert('Thêm vào giỏ hàng thành công!')
            }
        });
    });
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
    
        var id = $('#id').val();
        var quantity = $('#quantity').val();
        var title = $('#title').val();
        var price = $('#price').val();
        var sale = $('#sale').val();
        var image = $('#image').val();
    
        $.ajax({
            url: "http://127.0.0.1:8000/cart/add",
            method: 'POST',
            data: {
                id: id,
                quantity: quantity,
                title: title,
                price: price,
                sale: sale,
                image: image,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                // Xử lý kết quả trả về nếu cần
            }
        });
    });
});
