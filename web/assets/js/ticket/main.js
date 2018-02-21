$(document).ready(function () {
    $(".js-buy").on('click', function (event) {
        $item = $(this);
        if ($item.attr('href') === "#") {
            event.preventDefault();
            event.stopPropagation();
        }
        $id = $item.attr('data-url');
        axios.get(Routing.generate('cart_add_item', {match: $id}))
            .then(function (response) {
                $item.text('Go to cart');
                $item.attr('href', Routing.generate('cart_index'));
                axios.get(Routing.generate('cart_modal'))
                    .then(function (response) {
                        $('#js-iteme').empty().append(response.data);
                    })
                    .catch(function (err) {

                    });
            }).catch(function (err) {
            console.log(err);
        });
    });
});