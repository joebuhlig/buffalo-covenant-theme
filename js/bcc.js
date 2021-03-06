jQuery(function($) {
//jQuery is required to run this code

$("#site-navigation button").click(function(e){
    $("#site-navigation").toggleClass("toggled");
    e.stopPropagation();
})

if (navigator.userAgent.match(/Mobile|webOS|Nexus 7/)){
    $(".video-container video").remove();
    $(".video-container .poster").removeClass("hidden");
};
if (navigator.userAgent.match(/Mobile|webOS|Nexus 7/) && !navigator.userAgent.match(/Tablet|iPad/i)){
    $("body").addClass("mobile");
    $("#header-img").attr("src", $("#header-img").attr("mobile-src"));
}
else{
    $("#header-img").attr("src", $("#header-img").attr("desktop-src"));
}

$( document ).ready(function() {
    scaleVideoContainer();

    initBannerVideoSize('.video-container .filter');
    initBannerVideoSize('.video-container video');


    $(window).on('resize', function() {
        scaleVideoContainer();
        scaleBannerVideoSize('.video-container .filter');
        scaleBannerVideoSize('.video-container video');
    });
    

    if ($(window).scrollTop() > 0){
        $(".main-navigation").addClass("scrolled");
    }
    else {
        $("#site-navigation").removeClass("scrolled");
    }
        
    $(document).on('scroll', function() {
        if ($(window).scrollTop() > 0){
            $(".main-navigation").addClass("scrolled");
        }
        else {
            $("#site-navigation").removeClass("scrolled");
        }
    });

    $(".main-navigation .top-level-menu a:first").on('click', function(e){
        if($(this).hasClass('sub-menu')) {
            return;
        }        
        e.preventDefault();
        $(".main-navigation .top-level-menu ul:first").slideToggle(200);
    });

    jQuery('li.mega-menu-item').on('open_panel', function() {
        if ($('.mega-menu-open').length){
            
        }
        $(".main-navigation").addClass("open-menu");
    })
    jQuery('li.mega-menu-item').on('close_panel', function() {
        if (!$('.mega-menu-open').length){
            $(".main-navigation").removeClass("open-menu");
        }
    })

    $(".mega-menu-toggle").on('click', function(){
        if ($('.mega-menu-open').length){
            $(".main-navigation").addClass("open-menu");
        }
        else{
            $(".main-navigation").removeClass("open-menu");
        }
    })

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

    $(".tile-toggle").click(function(e){
        $tile = $(this).parents(".widget_page_tile_widget");
        $tileDescription = $tile.find(".page-tile-text");
        $(this).toggleClass("rotated");
        $tileDescription.slideToggle(200);
    });

    $(".staff-member").click(function(e){
        e.stopPropagation();
        $bio = $(this).find(".staff-member-bio");
        minHeight = $bio.css('min-height');
        $bio.css('min-height',0).slideToggle(200, function(){
            $bio.css('min-height', minHeight);
        });
    });

    $('select[multiple]').each(function() { 
        $(this).attr('size', $(this).find('option').length);
    });

    $(window).click(function(){
        $(".main-navigation.searching #search-menu-item-form").fadeOut(200);
        $(".main-navigation .menu-main-menu-container a").fadeIn(200);
        $(".main-navigation").removeClass("searching");
        $("#site-navigation").removeClass("toggled");
        $(".staff-member-bio").slideUp(200);
    });

    setWeekCalClickEvent();
    $(document).on('DOMNodeInserted', function(e) {
        setWeekCalClickEvent();
    });

    $(".sermon-medium-toggle").click(function(){
        if ($(".sermon-player").hasClass("show-video")){
            $(".sermon-player").fadeOut(200, function(){
                $(".sermon-player").removeClass("show-video").addClass("show-audio").fadeIn(200);
            });
            $(".sermon-medium-toggle button").html("Watch Video?");
        }
        else if($(".sermon-player").hasClass("show-audio")){
            $(".sermon-player").fadeOut(200, function(){
                $(".sermon-player").removeClass("show-audio").addClass("show-video").fadeIn(200);
            });
            $(".sermon-medium-toggle button").html("Audio Only?");
        }
    })

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

    var height = $(window).height();
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
