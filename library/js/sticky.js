jQuery(document).ready(function ($) {
  // if ($(window).width() > 768) {
  var mn = $('#inner-header');
  mns = 'scrolled';
  hdr = $('#inner-header').height();
  content = $('#container');

  $(window).scroll(function () {
    if ($(this).scrollTop() > hdr) {
      mn.addClass(mns);
      content.css("margin-top", hdr);
    } else {
      mn.removeClass(mns);
      content.css("margin-top", '0');
    }
  });
  // }
});