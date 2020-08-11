<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("theme/hack4pizza/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("theme/hack4pizza/css/bootstrap-datetimepicker.min.css")}}">
    <link rel="stylesheet" href="{{asset("theme/hack4pizza/css/style.css")}}">
    <meta  name="csrf-token" content="{{ csrf_token() }}" />
    <?php $settings = \App\Setting::pluck('value','name')->toArray(); $fav = isset($settings['favicon']) ? $settings['favicon']:''; ?>

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("uploads/$fav")}}">
    <title><?php if(isset($title)){echo $title; } else echo config('app.name'); ?></title>
    @yield('stylesheets')
</head>
