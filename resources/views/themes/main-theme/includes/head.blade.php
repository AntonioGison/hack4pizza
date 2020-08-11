<?php
if(isset($settings['theme_color'])) {
    $theme_color = $settings['theme_color'];
}else {
    $theme_color = "#c73c1c";
}
if(isset($settings['favicon'])) {
    $favicon = $settings['favicon'];
}else {
    $favicon = "img/favicon.ico";
}
?>
<head>
    <meta
        id="MetaRating" name="Rating" content="mature" />
    <meta
        name="Robots" content="index,follow" />
    <meta
        name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
    <link
        href="http://fonts.googleapis.com/css?family=Rochester" rel="stylesheet" type="text/css" />
    <meta
        http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta
        name="description" content="Elite Lima" />
    <meta
        name="keywords" content="Elite Lima" />
    <meta
        http-equiv="content-language" content="en" />
    <meta
        name="language" content="en" />
    <title>{{$title}}</title>
    <link
        rel="icon" href="<?php if (isset($settings['favicon'])){echo $settings['favicon']; } ?>" type="image/x-icon" />
    <link
        rel="shortcut icon" href="<?php if (isset($settings['favicon'])){echo $settings['favicon']; } ?>" type="image/x-icon" />
    <link
        type="text/css" href="http://fonts.googleapis.com/css?family=Buenard:400,700" rel="stylesheet" media="All" />
    <link href="{{asset("theme/elite/css/mainie.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("theme/elite/css/font-awesome-ie7.css")}}" rel="stylesheet" type="text/css" />

    <script src="{{asset("theme/elite/js/dependencies/html5shim.js")}}"></script>


    <script type="text/javascript">var baseURL = 'http://elitelima.com/';
        var RecaptchaOptions = {

            theme : 'white'

        };
    </script>
    @yield('stylesheets')
</head>

    <!--=============== favicons ===============-->


