<?php
if(isset($settings['news_letter_text'])) {
    $news_letter_text = $settings['news_letter_text'];
}else {
    $news_letter_text = "loading......";
}
if(isset($settings['contact_info'])) {
    $contact_info = $settings['contact_info'];
}else {
    $contact_info = "";
}
if(isset($settings['contact_number'])) {
    $contact_number = $settings['contact_number'];
}else {
    $contact_number = "";
}
if(isset($settings['email'])) {
    $email = $settings['email'];
}else {
    $email = "";
}
if(isset($settings['facebook_page_url'])) {
    $facebook_page_url = $settings['facebook_page_url'];
}else {
    $facebook_page_url = "http://www.facebook.com/";
}
if(isset($settings['twitter_url'])) {
    $twitter_url = $settings['twitter_url'];
}else {
    $twitter_url = "http://www.twitter.com/";
}
if(isset($settings['linkedin_url'])) {
    $linkedin_url = $settings['linkedin_url'];
}else {
    $linkedin_url = "http://www.linkedin.com/";
}
if(isset($settings['logo'])) {
    $logo = $settings['logo'];
}else {
    $logo = "placeholder.jpg";
}
?>
<?php $settings = \App\Setting::pluck('value', 'name')->all(); if (isset($settings['footer_text'])){$footer = $settings['footer_text'];}else{$footer="";} ?>

<footer>
    <div
        class="row-fluid">
        <div
            class="span12">
            <div
                class="copyright">{{$footer}}</div>
            <div
                class="footerMenu"> <a
                    href="{{route("home")}}" class="">Home</a> &bull; <a
                    href="{{route("agency")}}" class="">Agency</a> &bull; <a
                    href="{{route("sitemap")}}">Sitemap</a></div>
        </div>
    </div>
    <div
        class="clearfix"></div>
</footer>
<div
    class="fullscreenImageViewer"></div>
