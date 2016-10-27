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
        $("body").removeClass("bio-open");
        $(".show-bio").removeClass("show-bio");
        $("#staff-member-bio-container").attr("data-member-id", 0);
        $("#staff-member-bio-container").slideUp(200);
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

    $(".staff-member").click(function(e){
        e.stopPropagation();
        $staffMember = $(this);
        groupWidth = $("#main").innerWidth();
        memberWidth = $staffMember.outerWidth(true);
        membersPerLine = Math.floor(groupWidth/memberWidth);
        currentMember = $staffMember.index() + 1;
        $bioContainer = $("#staff-member-bio-container");
        if ($staffMember.attr("data-member-id") == $bioContainer.attr("data-member-id")){
            $("body").removeClass("bio-open");
            $(".show-bio").removeClass("show-bio");
            $bioContainer.attr("data-member-id", 0);
            $bioContainer.slideUp(200);
            return;
        }
        if ($bioContainer.index() < currentMember){
            currentMember = currentMember - 1;
        }
        endOfRow = Math.min(Math.ceil(currentMember/membersPerLine) * membersPerLine, $(".staff-member").length);
        $("body").addClass("bio-open");
        $(".show-bio").removeClass("show-bio");
        pointerPosition = $staffMember.position().left - 20 + memberWidth/2 - $("#staff-member-bio-pointer").width()/2 - ($("#main").outerWidth(true) - $("#main").width())/2 - ($("#primary").outerWidth(true) - $("#main").outerWidth(true))/2;
        if ($bioContainer.is(':visible')){
            $("#staff-member-bio-container:visible").slideUp(200,function(){
                $staffMember.addClass("show-bio");
                $("#staff-member-bio-text").html($staffMember.find(".staff-member-bio").html());
                $("#staff-member-bio-pointer").css("left", pointerPosition);
                $bioContainer.attr("data-member-id", $staffMember.attr("data-member-id"));
                $bioContainer.insertAfter($(".staff-member").eq(endOfRow - 1));
                $bioContainer.slideDown(200);
            });    
        }
        else {
            $staffMember.addClass("show-bio");
            $("#staff-member-bio-text").html($staffMember.find(".staff-member-bio").html());
            $("#staff-member-bio-pointer").css("left", pointerPosition);
            $bioContainer.attr("data-member-id", $staffMember.attr("data-member-id"));
            $bioContainer.insertAfter($(".staff-member").eq(endOfRow - 1));
            $bioContainer.slideDown(200);
        }
    })

    scaleVideoContainer();

    initBannerVideoSize('.video-container .filter');
    initBannerVideoSize('.video-container video');

    resizeStaffGroup();

    $(window).on('resize', function() {
        scaleVideoContainer();
        scaleBannerVideoSize('.video-container .filter');
        scaleBannerVideoSize('.video-container video');
        resizeStaffGroup();
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

function resizeStaffGroup(){
    var groupWidth = $("#main").innerWidth();
    var memberWidth = $(".staff-member").outerWidth(true);
    var membersPerLine = Math.floor(groupWidth/memberWidth);
    $(".staff-group").width(membersPerLine * memberWidth);
}
});