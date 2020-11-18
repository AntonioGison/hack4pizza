<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  @yield('additional_meta')
  <?php
    $very_dark_bg = "#09062A";
    $dark_bg = "#25215A"; //#F3F3F3
    $dark_blue = "#3B3677"; //#FFFFFF;
    $light_color = "#ffffff"
  ?>
  <style>
    :root {
      --very-dark-bg: {{ $very_dark_bg }};
      --dark-bg: {{ $dark_bg }};
      --dark-blue: {{ $dark_blue }};
      --light-color : {{ $light_color }};
    }
  </style>
  @include('themes.new-theme.includes.load_css')
  @yield('additional_css')
</head>
@php
  $isLoggedin = 0;
  $loggedUserTheme = 0;
  $loggedUserSlug = '';
  if(Auth::check()) {
    $isLoggedin = 1;
    $loggedUser = auth()->user();
    $loggedUserTheme = $loggedUser->theme;
    $loggedUserSlug = $loggedUser->slug;
  }
@endphp
<body>
  @if(Auth::check())
    @include('themes.new-theme.includes.logged_header')
  @else
    @include('themes.new-theme.includes.header')
  @endif
  @yield('content')
  @include('themes.new-theme.includes.footer')
  @yield('models')
  @include('themes.new-theme.includes.load_js',['isLoggedin'=>$isLoggedin,'loggedUserTheme'=>$loggedUserTheme])
  @yield('additional_js')
  
</body>

</html>
