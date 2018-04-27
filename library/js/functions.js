jQuery(document).ready(function($){
    if ($(window).width() < 768) {
    
        $('#menu-nav button').addClass('rotate');

    //The menu button in the mobile version
        $('#menu-toggle').click(function() {
            $( 'nav' ).toggle('slow');
        });

    //The menu dropdown buttons
        $('#menu-nav button').click(function() {
            $(this).toggleClass('rotate');
            $( this ).next('.sub-menu').toggle('slow');
        });
    }
    
});