<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php $settings = \App\Setting::pluck('value','name')->toArray(); $fav = isset($settings['favicon']) ? $settings['favicon']:''; ?>

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("uploads/$fav")}}">
    <title><?php if(isset($title)){echo $title; } else echo config('app.name'); ?></title>

    <meta  name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{asset('admin/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">



    <!-- Menu CSS -->
    <link href="{{asset('admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{asset('admin/plugins/bower_components/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="{{asset('admin/plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{asset('admin/css/colors/megna-dark.css')}}" id="theme" rel="stylesheet">

    <link href="{{asset('admin/plugins/bower_components/switchery/dist/switchery.min.css')}}" rel="stylesheet" />

    <!-- morris CSS -->
    <link href="{{asset('admin/plugins/bower_components/morrisjs/morris.css')}}" rel="stylesheet">
    <!--Gauge chart CSS -->
    <link href="{{asset('admin/plugins/bower_components/Minimal-Gauge-chart/css/cmGauge.css')}}" rel="stylesheet" type="text/css" />

    <meta  name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{asset('admin/plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css')}}" rel="stylesheet">
    <style type="text/css">
        .bg-title .breadcrumb{
            margin-top: 15px !important;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
