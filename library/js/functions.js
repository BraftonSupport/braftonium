jQuery(document).ready(function($){
    if ($(window).width() < 768) {
    
        $('header nav button').addClass('rotate');

    //The menu button in the mobile version
        $('#menu-toggle').click(function() {
            $( 'nav' ).toggleClass('toggleon');
            $( this ).children( 'svg' ).toggle();
        });
    }
    //The menu dropdown buttons
        $('header nav button').click(function() {
            $(this).toggleClass('rotate');
            $( this ).next('.sub-menu').toggleClass('toggleon');
        });
});