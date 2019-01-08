jQuery(document).ready(function ($) {
    $('.validation .slick').slick({
        autoplay: true,
        dots: true,
        autoplaySpeed: 9500,
        adaptiveHeight: false,
    });
    $('.slideshow .slick').slick({
        arrows: true,
        autoplay: false,
        adaptiveHeight: false,
    });

    $('.slideshow .slick .prev').click(function () {
        $(this).parents('.slick').children('.slick-prev').click();
    });
    $('.slideshow .slick .next').click(function () {
        $(this).parents('.slick').children('.slick-next').click();
    });
});