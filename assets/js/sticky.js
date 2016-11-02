function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('.fixed-top-nav-top').offset().top;
    if (window_top > div_top) {
        $('#fixed-top-nav-sec').addClass('fixed-top-nav');
        $('#service').addClass('row-padding');
        $('#menu').addClass('row-padding-62');
    } else {
        $('#fixed-top-nav-sec').removeClass('fixed-top-nav');
        $('#service').removeClass('row-padding');
        $('#menu').removeClass('row-padding-62');
    }
}
$(function() {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});

$(document).ready(function(){
    $('a[href^="#"]').click(function(e) {
        $('html,body').animate({ scrollTop: jQuery(this.hash).offset().top}, 1000);
        return false;
    });
});
