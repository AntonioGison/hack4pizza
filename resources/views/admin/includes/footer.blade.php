<?php $settings = \App\Setting::pluck('value','name')->toArray(); $footer = isset($settings['footer_text']) ? $settings['footer_text']:''; ?>

<footer class="footer text-center"> {{$footer}} </footer>
