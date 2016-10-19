jQuery(function($) {
//jQuery is required to run this code

$("#site-navigation button").click(function(e){
    $("#site-navigation").toggleClass("toggled");
    e.stopPropagation();
})

$( document ).ready(function() {
    if (navigator.userAgent.match(/Mobile|webOS|Nexus 7/)){
        $(".video-container video").remove();
        $("body").addClass("mobile");
        $(".video-container .poster").removeClass("hidden");
    }
    

    $(document).on('scroll', function() {
        if ($(window).scrollTop() > 0){
            $(".main-navigation").addClass("scrolled");
            // $(".home #site-navigation .logo .light-logo").hide();
            // $(".home #site-navigation .logo .dark-logo").show();
        }
        else {
            $("#site-navigation").removeClass("scrolled");
            // $(".home #site-navigation .logo .dark-logo").hide();
            // $(".home #site-navigation .logo .light-logo").show();
        }
    });

    $(".main-navigation .top-level-menu a:first").on('click', function(e){
        if($(this).hasClass('sub-menu')) {
            return;
        }        
        e.preventDefault();
        $(".main-navigation .top-level-menu ul:first").slideToggle(200);
    });

    $(".main-navigation #search-menu-item").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $(".main-navigation").addClass("searching");
        $(".main-navigation .menu-main-menu-container a").fadeOut(200);
        $(".main-navigation #search-menu-item-form").fadeIn(200);
        $(".main-navigation #search-menu-item-form .search-field").focus();
    });

    $(".main-navigation #search-menu-item-form").click(function(e){
        e.stopPropagation();
    });

    $(window).click(function(){
        $(".main-navigation.searching #search-menu-item-form").fadeOut(200);
        $(".main-navigation .menu-main-menu-container a").fadeIn(200);
        $(".main-navigation").removeClass("searching");
        $("#site-navigation").removeClass("toggled");
    });

    setWeekCalClickEvent();
    $(document).on('DOMNodeInserted', function(e) {
        setWeekCalClickEvent();
    });

    scaleVideoContainer();

    initBannerVideoSize('.video-container .filter');
    initBannerVideoSize('.video-container video');

    $(window).on('resize', function() {
        scaleVideoContainer();
        scaleBannerVideoSize('.video-container .filter');
        scaleBannerVideoSize('.video-container video');
    });

});

function setWeekCalClickEvent(){
    $(".tribe-this-week-widget-day").unbind("click");
    $(".tribe-this-week-widget-day").click(function(){
        $(".tribe-this-week-widget-day-wrap").fadeOut(200);
        $(".this-week-today").removeClass("this-week-today");
        $(this).addClass("this-week-today");
        $(this).find(".tribe-this-week-widget-day-wrap").fadeIn(200);
    });
}

function scaleVideoContainer() {

    var height = $(window).height() + 5;
    var unitHeight = parseInt(height) + 'px';
    $('.homepage-hero-module').css('height',unitHeight);

}

function initBannerVideoSize(element){

    $(element).each(function(){
        $(this).data('height', $(this).height());
        $(this).data('width', $(this).width());
    });

    scaleBannerVideoSize(element);

}

function scaleBannerVideoSize(element){

    var windowWidth = $(window).width(),
    windowHeight = $(window).height() + 5,
    videoWidth,
    videoHeight;

    $(element).each(function(){
        var videoAspectRatio = $(this).data('height')/$(this).data('width');

        $(this).width(windowWidth);

        if(windowWidth < 1000){
            videoHeight = windowHeight;
            videoWidth = videoHeight / videoAspectRatio;
            $(this).css({'margin-top' : 0, 'margin-left' : -(videoWidth - windowWidth) / 2 + 'px'});

            $(this).width(videoWidth).height(videoHeight);
        }

        $('.homepage-hero-module .video-container video').addClass('fadeIn animated');

    });
}
});