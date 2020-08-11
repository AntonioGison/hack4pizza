<script src="{{asset('admin/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('admin/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--Counter js -->
<script src="{{asset('admin/plugins/bower_components/waypoints/lib/jquery.waypoints.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/counterup/jquery.counterup.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('admin/js/waves.js')}}"></script>
<!-- Vector map JavaScript -->
<script src="{{asset('admin/plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/vectormap/jquery-jvectormap-in-mill.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/vectormap/jquery-jvectormap-us-aea-en.js')}}"></script>

<!-- sparkline chart JavaScript -->
<script src="{{asset('admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('admin/js/custom.min.js')}}"></script>
<script src="{{asset('admin/js/custom_m.js')}}"></script>
<!--Style Switcher -->
<script src="{{asset('admin/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js')}}"></script>
<script src="{{asset('admin/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".colorpicker").asColorPicker();
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
    });
</script>
<script src="{{asset('admin/plugins/bower_components/switchery/dist/switchery.min.js')}}"></script>
<!--Style Switcher -->
<script src="{{asset('admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
