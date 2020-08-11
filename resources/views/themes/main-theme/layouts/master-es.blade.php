<!DOCTYPE html>
<html>
@include('themes.main-theme.includes.head-es')


<body>
@include('themes.main-theme.includes.nav-es')
@include('themes.main-theme.includes.header-es')
    @yield('content')
@include('themes.main-theme.includes.footer-es')
@include('themes.main-theme.includes.scripts')

</body>
</html>


