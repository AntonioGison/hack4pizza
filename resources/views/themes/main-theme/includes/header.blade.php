<?php
if(isset($settings['logo'])) {
    $logo = $settings['logo'];
}else {
    $logo = "logo.png";
}
if(isset($settings['lg_logo'])) {
    $lg_logo = $settings['lg_logo'];
}else {
    $lg_logo = "placeholder.jpg";
}
if(isset($settings['contact_number'])) {
    $contact_number = $settings['contact_number'];
}else {
    $contact_number = "111-2222-55555";
}
if(isset($settings['facebook_page_url'])) {
    $facebook_url = $settings['facebook_page_url'];
}else {
    $facebook_url = "http://www.facebook.com/";
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
if(isset($settings['contact_info'])) {
    $contact_info = $settings['contact_info'];
}else {
    $contact_info = "loading.....";
}
if(isset($settings['email'])) {
    $email = $settings['email'];
}else {
    $email = "loading.....";
}
if(isset($settings['theme_color'])) {
    $theme_color = $settings['theme_color'];
}else {
    $theme_color = "#000";
}
?>
@section('stylesheets')

@endsection

<header>
    <div
        class="container">
        <div
            class="row">
            <div
                class="span12">
                <div
                    class="logo">
                    <a href="{{route("home")}}" id="HomePageUrl1_HomePageUrl">
                        @if(File::exists('uploads/'.$logo))
                            <img src="{{asset("uploads/$logo")}}" alt="elitelima logo" width="">
                        @else
                            <img src="images/logo.png" alt="">
                        @endif

                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


