$(document).ready(function() {
  // Header Scroll
  $(window).on('scroll', function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
      $('#head').addClass('fixed');
    } else {
      $('#head').removeClass('fixed');
    }
  });

  // Fancybox
  $('.work-box').fancybox();

  // Flexslider
  $('.flexslider').flexslider({
    animation: "fade",
    directionNav: false,
  });

  // Page Scroll
  var sections = $('section')
    nav = $('nav[role="navigation"]');

  $(window).on('scroll', function () {
      var cur_pos = $(this).scrollTop();
      sections.each(function() {
        var top = $(this).offset().top - 76
            bottom = top + $(this).outerHeight();
        if (cur_pos >= top && cur_pos <= bottom) {
            nav.find('a').removeClass('active');
            nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
        }
      });
  });
  nav.find('a').on('click', function () {
      var $el = $(this)
        id = $el.attr('href');
    $('html, body').animate({
      scrollTop: $(id).offset().top - 75
    }, 500);
    return false;
  });

  // Mobile Navigation
  $('.nav-toggle').on('click', function() {
    $(this).toggleClass('close-nav');
    nav.toggleClass('open');
    return false;
  }); 
  nav.find('a').on('click', function() {
    $('.nav-toggle').toggleClass('close-nav');
    nav.toggleClass('open');
  });

     // Test for placeholder support
    $.support.placeholder = (function(){
        var i = document.createElement('input');
        return 'placeholder' in i;
    })();

    // Hide labels by default if placeholders are supported
    if($.support.placeholder) {
        $('.form-label').each(function(){
            $(this).addClass('js-hide-label');
        });  

        // Code for adding/removing classes here
        $('.form-group').find('input, textarea').on('keyup blur focus', function(e){
            
            // Cache our selectors
            var $this = $(this),
                $parent = $this.parent().find("label");
          
            switch(e.type) {
              case 'keyup': {
                 $parent.toggleClass('js-hide-label', $this.val() == '');
              } break;
              case 'blur': {
                if( $this.val() == '' ) {
                    $parent.addClass('js-hide-label');
                } else {
                    $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
                }
              } break;
              case 'focus': {
                if( $this.val() !== '' ) {
                    $parent.removeClass('js-unhighlight-label');
                }
              } break;
              default: break;
            }
           
        });
    } 
});
    // intro button
    $("#intro a").click(function() {
     $('html, body').animate({
      scrollTop: $("#places").offset().top
      }, 2000);
    });

  //Gallery script
  $(".filter-button").click(function () {
    var value = $(this).attr('data-filter');

    if (value == "all") {

      $('.filter').show('1000');
    } else {

      $(".filter").not('.' + value).hide('3000');
      $('.filter').filter('.' + value).show('3000');

    }


    if ($(".filter-button").removeClass("active")) {
      $(this).removeClass("active");
    }
    $(this).addClass("active");

  });
$(function() {

    $('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });

});
//places carousel
  $("#places-carousel").owlCarousel({
    items : 3,
    lazyLoad : true,
    autoPlay:true,
    autoplayHoverPause: true,
    navigation : true,
    navigationText: ['<i class="fa fa-chevron-right color-grey"></i>','<i class="fa fa-chevron-left color-grey"></i>'],   
    pagination: false,
    itemsCustom : false,
    itemsDesktop : [1199, 3],
    itemsDesktopSmall : [980, 3],
    itemsTablet : [768, 2],
    itemsTabletSmall : false,
    itemsMobile : [479, 1]
  });