<!DOCTYPE html>
<html>
@include('themes.main-theme.includes.head')


<body>
@include('themes.main-theme.includes.nav')
@include('themes.main-theme.includes.header')
    @yield('content')
@include('themes.main-theme.includes.footer')
@include('themes.main-theme.includes.scripts')

</body>
</html>


