$(function () {
    $('#menuToggle').on('click', function(event) {
        $('body').toggleClass('open');
    });

    $('.chosen-select').chosen();
});
