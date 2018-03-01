jQuery(document).ready(function($){
  
    var mn = $('.header');
        mns = 'scrolled';
        hdr = $('.header').height();
        content = $('#content');
  
    $(window).scroll(function() {
      if( $(this).scrollTop() > hdr ) {
        mn.addClass(mns);
        content.css( "margin-top", hdr );
      } else {
        mn.removeClass(mns);
        content.css( "margin-top", '0' );
      }
    });
  
  });