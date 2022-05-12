$(function() {
    const $cartQuantity = $('#cart-quantity');
    const $addToCart = $('.btn-add-to-cart');
    $addToCart.click(e => {
        e.preventDefault();
        const $this = $(e.target);
        const id = $this.closest('.product-items').data('key');
        console.log(id);
        $.ajax({
            method: 'POST',
            url: $this.attr('href'),
            data: {id},
            success: function() {
                console.log(arguments)
                $cartQuantity.text(parseInt($cartQuantity.text() || 0) + 1);
                console.log($cartQuantity)
            },
            beforeSend: function (){
                console.log(id, this.data)
            }
        })
    })
});