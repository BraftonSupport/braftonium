jQuery(document).ready(function($){
    if ($(window).width() < 768) {
        $('#menu-toggle').click(function() {
            $( 'nav' ).toggle('slow');
        });
    }
});