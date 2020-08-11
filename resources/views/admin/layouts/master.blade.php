<!DOCTYPE html>
<html lang="en">
@include('admin.includes.head')
@yield('stylesheets')

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
@include('admin.includes.pre_loader')
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    @include('admin.includes.navbar')
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    @include('admin.includes.sidebar')
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">

        @yield('content')
        <!-- /.container-fluid -->
        @include('admin.includes.footer')
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
@include('admin.includes.footer-scripts')
@yield('scripts')
</body>

</html>


{{--@if(Session::has('success_message'))--}}
    {{--<div class="alert alert-success">--}}
        {{--{{ Session::get('success_message') }}--}}
    {{--</div>--}}
{{--@endif--}}
{{--@if(Session::has('error_message'))--}}
    {{--<div class="alert alert-danger">--}}
        {{--{{ Session::get('error_message') }}--}}
    {{--</div>--}}
{{--@endif--}}

