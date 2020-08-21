<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  @yield('additional_meta')
  @include('themes.new-theme.includes.load_css')
  @yield('additional_css')
</head>
<body>
  @include('themes.new-theme.includes.header')
  @yield('content')
  @include('themes.new-theme.includes.footer')
  @include('themes.new-theme.includes.load_js')
  @yield('additional_js')
</body>

</html>
