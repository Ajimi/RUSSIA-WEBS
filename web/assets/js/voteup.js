$(document).ready(function (event) {

    check();
    $('.js-voteup').on('click', function (ev) {
        ev.preventDefault();
        ev.stopPropagation();
        $item = $(this);
        $id = $item.attr('data-url');
        axios
            .get(Routing.generate('vote_up', {'id': $id}))
            .then(function (response) {
                console.log(response);
                $response = response['data'];

                if ($response['result']) { // result == true
                    if ($response['type'] === "remove") {
                        $('#js-icon').removeClass().addClass('icon material-icons-thumb_up');
                        // Todo toggle the vote or remove it
                        console.log("Vote remove");
                    } else {
                        $('#js-icon').removeClass().addClass('icon material-icons-thumb_down');
                        ;
                        console.log("Vote up");
                    }
                    // change color
                    $('#js-total-votes').text($response['total']);
                } else {
                    $.redirect(Routing.generate(' fos_user_registration_register'));
                }
            }).catch(function (error) {

        })
    });

    function check() {
        $item = $('.js-voteup');
        $id = $item.attr('data-url');

        axios.get(Routing.generate('vote_check', {'id': $id}))
            .then(function (response) {
                $response = response['data'];
                if ($response['result']) {
                    $('#js-icon').removeClass().addClass('icon material-icons-thumb_up');
                } else {
                    $('#js-icon').removeClass().addClass('icon material-icons-thumb_down');


                }
            })
            .catch(function (response) {

            })
    }
});