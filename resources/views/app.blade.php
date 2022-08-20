<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
        <title inertia>{{ config('app.name', 'ADMFPL') }}</title>
        <!-- Google font-->
        <link href="{{ asset('assets/fonts/font-nunito.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/fonts/font-montserrat.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/fonts/font-roboto.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/fonts/font-rubik.css') }}" rel="stylesheet">
        <!-- Font Awesome-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/brands.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/solid.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/v5-font-face.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/v4-shims.css') }}">

       <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/icofont/icofont.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/icofont/icofont.min.css') }}">
       <!-- Themify icon-->
       <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/themify-icons/themify-icons.css') }}">
        <!-- Feather icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
        <!-- Plugins css start-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owlcarousel.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/whether-icon.css') }}">
        <!-- Plugins css start-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }} ">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owlcarousel.css') }} ">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/range-slider.css') }} ">
        <!-- Plugins css Ends-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
        <!-- Responsive css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        @inertiaHead
    </head>
    <body>
        <!-- Loader starts-->
        <div class="loader-wrapper">
            <div class="theme-loader">
            <div class="loader-p"></div>
            </div>
        </div>
        <!-- Loader ends-->
        <!-- page-wrapper Start-->
        @inertia
        <!-- latest jquery-->
        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>

        {{-- <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script> --}}
        <script src="{{ asset('assets/js/config.js') }}"></script>
        <!-- feather icon js-->
        {{-- <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script> --}}
        <script src="{{ asset('assets/fontawesome/js/all.js') }}"></script>
        <script src="{{ asset('assets/fontawesome/js/brands.js') }}"></script>
        <script src="{{ asset('assets/fontawesome/js/solid.js') }}"></script>
        <script src="{{ asset('assets/fontawesome/js/fontawesome.js') }}"></script>
        <script src="{{ asset('assets/fontawesome/js/v4-shims.js') }}"></script>
        {{-- <script src="{{ asset('js/feather.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/feather.js') }}"></script> --}}
        <!-- Sidebar jquery-->
        <!-- Bootstrap js-->
        <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
        <!-- Plugins JS start-->
        <script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
        <script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script> --}}
        <script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
        <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
        <script src="{{ asset('assets/js/general-widget.js') }}"></script>
        <script src="{{ asset('assets/js/height-equal.js') }}"></script>
        <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
         <!-- Plugins JS Ends-->
        <!-- Theme js-->
        {{-- <script src="{{ asset('assets/js/script.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/feather/feather.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script> --}}
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        {{-- <script src="https://unpkg.com/feather-icons@4.29.0/dist/feather.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> --}}
        <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
        <script src="{{ asset('js/quagga.min.js') }}"></script>
        <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
        {{-- <script src="{{ asset('assets/js/form-wizard/form-wizard.js') }}"></script> --}}

        {{-- <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/js/sweet-alert/app.js') }}"></script> --}}
        <!-- login js-->
        <!-- Plugin used-->
        <script>
            var primary = localStorage.getItem("primary") || '#24695c';
            var secondary = localStorage.getItem("secondary") || '#ba895d';

            window.vihoAdminConfig = {
                // Theme Primary Color
                primary: primary,
                // theme secondary color
                secondary: secondary,
            };
            // defalt layout
            $("#default-demo").click(function(){
                localStorage.setItem('page-wrapper', 'page-wrapper compact-wrapper');
                localStorage.setItem('page-body-wrapper', 'sidebar-icon');
            });
            // compact layout
            $("#compact-demo").click(function(){
                localStorage.setItem('page-wrapper', 'page-wrapper compact-wrapper compact-sidebar');
                localStorage.setItem('page-body-wrapper', 'sidebar-icon');
            });
            // modern layout
            $("#modern-demo").click(function(){
                localStorage.setItem('page-wrapper', 'page-wrapper compact-wrapper modern-sidebar');
                localStorage.setItem('page-body-wrapper', 'sidebar-icon');
            });
            $('.loader-wrapper').fadeOut('slow', function () {
                $(this).remove();
            });
            $(".mode").on("click", function () {
                // $('.mode-sun').toggleClass("show")
                $("#iconMode").toggleClass("fa-solid fa-lightbulb").toggleClass("fa-solid fa-moon");
                $("body").toggleClass("dark-only");
                var color = window.$(this).attr("data-attr");
                localStorage.setItem("body", "dark-only");
            });
            // toggle sidebar
            var nav = $('.main-nav');
            var header = $('.page-main-header');
            var toggle_nav_top = $('#sidebar-toggle');
            toggle_nav_top.click(function() {
                console.log('click en el icono');
                // var this = $(this);
                var nav = $('.main-nav');
                nav.toggleClass('close_icon');
                header.toggleClass('close_icon');
            });

            $( window ).resize(function() {
                console.log('rize esta iniciando');
                var nav = $('.main-nav');
                var header = $('.page-main-header');
                var toggle_nav_top = $('#sidebar-toggle');
                toggle_nav_top.click(function() {
                    console.log('click en el iconossss');
                    // var this = $(this);
                    var nav = $('.main-nav');
                    nav.toggleClass('close_icon');
                    header.toggleClass('close_icon');
                });
            });
            $body_part_side = $('.body-part');
            $body_part_side.click(function(){
                $toggle_nav_top.attr('checked', false);
                $nav.addClass('close_icon');
                $header.addClass('close_icon');
            });
            // document sidebar
            $('.mobile-sidebar').click(function(){
                $('.document').toggleClass('close')
            });
            // $(".mobile-sidebar").click(function(){
            //   $("p").toggleClass("main");
            // });

            //    responsive sidebar
            var $window = $(window);
            var widthwindow = $window.width();
            (function($) {
            "use strict";
            if(widthwindow+17 <= 993) {
                $toggle_nav_top.attr('checked', false);
                $nav.addClass("close_icon");
                $header.addClass("close_icon");
            }
            })(jQuery);
            $( window ).resize(function() {
                var widthwindaw = $window.width();
                if(widthwindaw+17 <= 991){
                    $toggle_nav_top.attr('checked', false);
                    $nav.addClass("close_icon");
                    $header.addClass("close_icon");
                }else{
                    $toggle_nav_top.attr('checked', true);
                    $nav.removeClass("close_icon");
                    $header.removeClass("close_icon");
                }
            });

            // horizontal arrowss
            var view = $("#mainnav");
            var move = "500px";
            var leftsideLimit = -500

            // var Windowwidth = jQuery(window).width();
            // get wrapper width
            var getMenuWrapperSize = function () {
                return $('.sidebar-wrapper').innerWidth();
            }
            var menuWrapperSize = getMenuWrapperSize();

            if ((menuWrapperSize) >= '1660') {
                var sliderLimit = -3000

            } else if ((menuWrapperSize) >= '1440') {
                var sliderLimit = -3600
            } else {
                var sliderLimit = -4200
            }

            $("#left-arrow").addClass("disabled");
            $("#right-arrow").click(function () {
                var currentPosition = parseInt(view.css("marginLeft"));
                if (currentPosition >= sliderLimit) {
                    $("#left-arrow").removeClass("disabled");
                    view.stop(false, true).animate({
                        marginLeft: "-=" + move
                    }, {
                        duration: 400
                    })
                    if (currentPosition == sliderLimit) {
                        $(this).addClass("disabled");
                        console.log("sliderLimit", sliderLimit);
                    }
                }
            });
            $("#left-arrow").click(function () {
                var currentPosition = parseInt(view.css("marginLeft"));
                if (currentPosition < 0) {
                    view.stop(false, true).animate({
                        marginLeft: "+=" + move
                    }, {
                        duration: 400
                    })
                    $("#right-arrow").removeClass("disabled");
                    $("#left-arrow").removeClass("disabled");
                    if (currentPosition >= leftsideLimit) {
                        $(this).addClass("disabled");
                    }
                }

            });
            // page active
                $( ".main-navbar" ).find( "a" ).removeClass("active");
                $( ".main-navbar" ).find( "li" ).removeClass("active");

                var current = window.location.pathname
                $(".main-navbar ul>li a").filter(function() {

                    var link = $(this).attr("href");
                    if(link){
                        if (current.indexOf(link) != -1) {
                            $(this).parents().children('a').addClass('active');
                            $(this).parents().parents().children('ul').css('display', 'block');
                            $(this).addClass('active');
                            $(this).parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                            $(this).parent().parent().parent().parent().parent().children('a').find('div').replaceWith('<div class="according-menu"><i class="fa fa-angle-down"></i></div>');
                            return false;
                        }
                    }
                });

                /* $('.custom-scrollbar').animate({
                    scrollTop: $('a.nav-link.menu-title.active').offset().top - 500
                }, 1000); */

            function toggleFullScreen() {
                if ((document.fullScreenElement && document.fullScreenElement !== null) ||
                    (!document.mozFullScreen && !document.webkitIsFullScreen)) {
                    if (document.documentElement.requestFullScreen) {
                        document.documentElement.requestFullScreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullScreen) {
                        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.cancelFullScreen) {
                        document.cancelFullScreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitCancelFullScreen) {
                        document.webkitCancelFullScreen();
                    }
                }
            }
            (function($, window, document, undefined) {
                "use strict";
                var $ripple = $(".js-ripple");
                $ripple.on("click.ui.ripple", function(e) {
                    var $this = $(this);
                    var $offset = $this.parent().offset();
                    var $circle = $this.find(".c-ripple__circle");
                    var x = e.pageX - $offset.left;
                    var y = e.pageY - $offset.top;
                    $circle.css({
                        top: y + "px",
                        left: x + "px"
                    });
                    $this.addClass("is-active");
                });
                $ripple.on(
                    "animationend webkitAnimationEnd oanimationend MSAnimationEnd",
                    function(e) {
                        $(this).removeClass("is-active");
                    });
            })(jQuery, window, document);
        </script>
    </body>
</html>
