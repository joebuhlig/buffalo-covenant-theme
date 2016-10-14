jQuery(function($) {
//jQuery is required to run this code
var container, button, menu, links, subMenus, i, len;

container = document.getElementById( 'site-navigation' );
if ( ! container ) {
    return;
}

button = container.getElementsByTagName( 'button' )[0];
if ( 'undefined' === typeof button ) {
    return;
}

menu = container.getElementsByTagName( 'ul' )[0];

// Hide menu toggle button if menu is empty and return early.
if ( 'undefined' === typeof menu ) {
    button.style.display = 'none';
    return;
}

menu.setAttribute( 'aria-expanded', 'false' );
if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
    menu.className += ' nav-menu';
}

button.onclick = function() {
    if ( -1 !== container.className.indexOf( 'toggled' ) ) {
        container.className = container.className.replace( ' toggled', '' );
        button.setAttribute( 'aria-expanded', 'false' );
        menu.setAttribute( 'aria-expanded', 'false' );
    } else {
        container.className += ' toggled';
        // $(".main-navigation .top-level-menu").unbind('mouseenter mouseleave');
        button.setAttribute( 'aria-expanded', 'true' );
        menu.setAttribute( 'aria-expanded', 'true' );
    }
};

$( document ).ready(function() {
    if (navigator.userAgent.match(/Mobile|webOS|Nexus 7/)){
        $(".video-container video").remove();
        $("body").addClass("mobile");
        $(".video-container .poster").removeClass("hidden");
    }
    

    $(document).on('scroll', function() {
        if ($(window).scrollTop() > 0){
            $(".main-navigation").addClass("scrolled");
            $("#site-navigation .logo .light-logo").hide();
            $("#site-navigation .logo .dark-logo").show();
        }
        else {
            $("#site-navigation").removeClass("scrolled");
            $("#site-navigation .logo .dark-logo").hide();
            $("#site-navigation .logo .light-logo").show();
        }
    });

    $(".main-navigation .top-level-menu a:first").on('click', function(e){
        if($(this).hasClass('sub-menu')) {
            return;
        }        
        console.log(this);
        e.preventDefault();
        $(".main-navigation .top-level-menu ul:first").slideToggle(200);
    })

    scaleVideoContainer();

    initBannerVideoSize('.video-container .filter');
    initBannerVideoSize('.video-container video');

    $(window).on('resize', function() {
        scaleVideoContainer();
        scaleBannerVideoSize('.video-container .filter');
        scaleBannerVideoSize('.video-container video');
    });

});

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