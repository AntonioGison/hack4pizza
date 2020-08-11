<!doctype html>
<html lang="en">

@include('user.includes.head')

<body>

@include('user.includes.header-top')

@yield('content')

@include('user.includes.footer')

@yield('models')

@include('user.includes.footer-scripts')
@yield('scripts')
</body>


