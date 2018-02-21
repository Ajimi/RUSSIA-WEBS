$(document).ready(function () {
    $('.js-remove').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $id = $(this).attr('data-url');
        $item = $(this);
        axios.get(Routing.generate('cart_remove_item', {id: $id}))
            .then(function (response) {
                $item.closest('tr').remove();
            }).catch(function (err) {
            console.log(err);
        });
    });
});