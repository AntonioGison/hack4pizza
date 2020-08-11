<?php //dd("working"); ?>
@extends('themes.main-theme.layouts.home')
<?php
if(isset($settings['site_title'])) {
    $title = $settings['site_title'];
}else {
    $title = "no title";
}
?>
@section('title',$title)
@section("stylesheets")

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>header { display: none; }
        .footerMenu { display: none; }
        .copyright { display: block; }
        .carousel-control{
            top: 50% !important;
        }
        .carousel-caption{
            background: none !important;
        }
    </style>
@endsection
