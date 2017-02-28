//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

/*
// Disable the two taps on iOS devices
$(document).ready(function() {
  if (window.matchMedia('max-width: 900px)').matches) {
   $('a').on('click touchend', function(e) {
      var el = $(this);
      var link = el.attr('href');
      window.location = link;
   });
  }
});
*/

// Tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

//jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
        $(".logobefore").addClass("logoafter");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
        $(".logobefore").removeClass("logoafter");
    }
});

//Animate the resume button
$(window).scroll(function() {
    $('#reAnim').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow+400) {
        $(this).addClass("animated shake");
      }
    });
});

$(function() {
    $("body").on("input propertychange", ".floating-label-form-group", function(e) {
        $(this).toggleClass("floating-label-form-group-with-value", !! $(e.target).val());
    }).on("focus", ".floating-label-form-group", function() {
        $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function() {
        $(this).removeClass("floating-label-form-group-with-focus");
    });
});