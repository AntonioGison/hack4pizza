<div id="footer">
    <div class="container">
        <div class="row">
            <?php $settings = \App\Setting::pluck('value','name')->toArray();
                 $link1_text = isset($settings['link1_text']) ? $settings['link1_text']:'link 1';
                 $link2_text = isset($settings['link2_text']) ? $settings['link2_text']:'link 2';
                 $link3_text = isset($settings['link3_text']) ? $settings['link3_text']:'link 3';
                 $link4_text = isset($settings['link4_text']) ? $settings['link4_text']:'link 4';
                 $link1_url = isset($settings['link1_url']) ? $settings['link1_url']:'#';
                 $link2_url = isset($settings['link2_url']) ? $settings['link2_url']:'#';
                 $link3_url = isset($settings['link3_url']) ? $settings['link3_url']:'#';
                 $link4_url = isset($settings['link4_url']) ? $settings['link4_url']:'#';
                 $footer = isset($settings['footer_text']) ? $settings['footer_text']:'Hack4.pizza 2019 Copyrights, an Antonio Co.';
            ?>
            <div class="col-md-12 text-center">
                <a href="{{$link1_url}}">{{$link1_text}}</a>
                <a href="{{$link2_url}}">{{$link2_text}}</a>
                <a href="{{$link3_url}}">{{$link3_text}}</a>
                <a href="{{$link4_url}}">{{$link4_text}}</a>

            </div>
            <div class="col-md-12 text-center">
                <p class="font-weight-bold">{{$footer}}.</p>
            </div>
        </div>
    </div>
</div>
