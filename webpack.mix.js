let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    'public/theme/bootstrap/dist/css/bootstrap.min.css',
    'public/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
    'public/theme/css/animate.css',
    'public/theme/css/style.css',
    'public/theme/css/colors/megna-dark.css',
], 'public/theme/css/theme.css');
mix.styles([
    'public/admin/bootstrap/dist/css/bootstrap.min.css',
    'public/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
    'public/admin/plugins/bower_components/chartist-js/dist/chartist.min.css',
    'public/admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css',
    'public/admin/plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.css',
    'public/admin/css/animate.css',
    'public/admin/css/style.css',
    'public/admin/css/colors/default.css',
], 'public/admin/css/user.css');
mix.scripts([
    'public/admin/plugins/bower_components/jquery/dist/jquery.min.js',
    'public/theme/bootstrap/dist/js/bootstrap.min.js',
    'public/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
    'public/theme/js/jquery.slimscroll.js',
    'public/theme/js/waves.js',
    'public/theme/js/custom.js',
], 'public/theme/js/theme.js');
mix.scripts([
    'public/admin/plugins/bower_components/jquery/dist/jquery.min.js',
    'public/admin/bootstrap/dist/js/bootstrap.min.js',
    'public/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
    'public/admin/plugins/bower_components/waypoints/lib/jquery.waypoints.js',
    'public/admin/plugins/bower_components/counterup/jquery.counterup.min.js',
    'public/admin/js/jquery.slimscroll.js',
    'public/admin/js/waves.js',
    'public/admin/plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js',
    'public/admin/plugins/bower_components/vectormap/jquery-jvectormap-world-mill-en.js',
    'public/admin/plugins/bower_components/vectormap/jquery-jvectormap-in-mill.js',
    'public/admin/plugins/bower_components/vectormap/jquery-jvectormap-us-aea-en.js',
    'public/admin/plugins/bower_components/chartist-js/dist/chartist.min.js',
    'public/admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js',
    'public/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js',
    'public/admin/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js',
    'public/admin/js/custom.min.js',
    'public/admin/js/dashboard3.js',
    'public/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
], 'public/admin/js/user.js');

