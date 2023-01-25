$(function() {
    /*-------------------------------------Header Fixed-------------------------*/
    "use strict";
    $(function () {
        var header = $(".start-style");
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 10) {
                header.removeClass('start-style').addClass("scroll-on");
            } else {
                header.removeClass("scroll-on").addClass('start-style');
            }
        });
    });

    /*-------------------------------------Mobile Menu-------------------------*/
    // var ico = $('<span></span>');
    // $('li.sub_menu_open').append(ico);

    // $("#menu_res").click(function() {
    //     $("#res_nav").toggleClass('left0');
    // });

    // $('li span').on("click", function(e) {
    //     if ($(this).hasClass('open')) {

    //         $(this).prev('ul').slideUp(300, function() {});

    //     } else {
    //         $(this).prev('ul').slideDown(300, function() {});
    //     }
    //     $(this).toggleClass("open");
    // });
    // $('#menu_res').click(function() {
    //     $(this).toggleClass('menu_responsiveTo')
    // });



    /*-------------------------------------ScrollTop-------------------------*/

    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('.scrollup').fadeIn();
            $('.arrow-show').fadeIn();
        } else {
            $('.scrollup').fadeOut();
            $('.arrow-show').fadeOut();
        }
    });
    $('.scrollup').click(function(e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, 300);
        return false;
    });
    /*-------------------------------------Header Mobile Search-----------------------------------*/
    $(document).on('click', '.scr_mob', function(){
        $('.scr_mob_slide').slideToggle();
    });
    
    /*-------------------------------------Same Height-----------------------------------*/
    // 1
    // var sameHeight = 0;
    // $('.same_height1').each(function () {
    //     if ($(this).outerHeight() >= sameHeight) {
    //         sameHeight = $(this).outerHeight();
    //     }
    // });
    // $('.same_height1').css({
    //     'min-height': sameHeight
    // });
    /*-------------------------------------Password Eye-----------------------------------*/
    // $(document).on('click', '.pass_eye', function(){   
    //     if($(this).closest('.add-pass-eye').find(".pass_input").attr('type')=='password'){
    //     $(this).closest('.add-pass-eye').find(".pass_input").attr('type','text');
    //     $(this).closest('.add-pass-eye').find(".far").addClass("fa-eye").removeClass("fa-eye-slash");
    //     }else{
    //     $(this).closest('.add-pass-eye').find(".pass_input").attr('type', 'password');
    //     $(this).closest('.add-pass-eye').find(".far").removeClass("fa-eye").addClass("fa-eye-slash");
    //     } 
    // });

    

    // side menu close start
    $(document).on('click', '.side-menu-close', function(){
        $(this).toggleClass("closed");
    });

    /*-------------------------------------First Order Slider-----------------------------------*/
	
    
});