<!DOCTYPE html>
<html>
@include('themes.new-theme.includes.head')


<body>
@include('themes.new-theme.includes.nav')
@include('themes.new-theme.includes.header')
    @yield('content')
@include('themes.new-theme.includes.footer')
@include('themes.new-theme.includes.scripts')

</body>
</html>


