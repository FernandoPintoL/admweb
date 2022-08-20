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
        {{--INICIO DE LINK ADMIN--}}
        <!-- Google font-->
        <link href="{{ asset('assets/fonts/font-nunito.css')  }}" rel="stylesheet">
        <link href="{{ asset('assets/fonts/font-montserrat.css')  }}" rel="stylesheet">
        <link href="{{ asset('assets/fonts/font-roboto.css')  }}" rel="stylesheet">
        <link href="{{ asset('assets/fonts/font-rubik.css')  }}" rel="stylesheet">
        <!-- Font Awesome-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
       <!-- ico-font-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/icofont/icofont.css') }}">
       <!-- Themify icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/themify-icons/themify-icons.css')  }}">
       <!-- Feather icon-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css')  }}">
{{--        <!-- Plugins css start-->--}}
{{--        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">--}}
{{--        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chartist.css') }}">--}}
{{--        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">--}}
{{--        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">--}}
{{--        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vector-map.css') }}">--}}
        <!-- Plugins css Ends-->
        <!-- Bootstrap css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
        <!-- App css-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css')  }}">
{{--        <link id="color" rel="stylesheet" href="https://laravel.pixelstrap.com/viho/assets/css/color-1.css" media="screen">--}}
        <!-- Responsive css-->
        {{--FIN DE LINK ADMIN--}}

        {{--INICIO DE LINK POR DEFECTO--}}
        <!-- Fonts -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        @inertiaHead
    </head>
    <body>
        @inertia

        <!-- latest jquery-->
{{--        <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>--}}
{{--        <script src="{{ asset('assets/js/feather.min.js') }}"></script>--}}
{{--        <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>--}}
{{--        <script src="{{ asset('assets/js/sidebar-menu.js')}}"></script>--}}
{{--        <script src="{{ asset('assets/js/config.js')}}"></script>--}}
{{--        <script src="{{ asset('assets/js/bootstrap/popper.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/chart/chartist/chartist.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>--}}
{{--        <script src="{{ asset('assets/js/chart/knob/knob.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/chart/knob/knob-chart.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/prism/prism.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/clipboard/clipboard.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/counter/jquery.counterup.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/counter/counter-custom.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/custom-card/custom-card.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/vector-map/jquery-jvectormap-2.0.2.min.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-au-mill.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-in-mill.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/vector-map/map/jquery-jvectormap-asia-mill.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/dashboard/default.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/notify/index.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}} "></script>--}}
{{--        <script src="{{ asset('assets/js/script.js')}}"></script>--}}
{{--        <script src="{{ asset('assets/js/theme-customizer/customizer.js')}}"></script>--}}
    </body>
</html>
