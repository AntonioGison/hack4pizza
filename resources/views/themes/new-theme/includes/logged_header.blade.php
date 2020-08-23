<div id="header" class="top-bar">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-5 logo">
        <a href="{{ url('/') }}">
          <img alt="Hack4 Pizza" src="{{asset('new-theme/images/logo.png') }}" />
        </a>
      </div>
      <div class="col-6 offset-1 login_wrapper">
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        <div class="row">
          <div class="col-8 less-padding">
            <input type="text" id="searchUser" class="form-control search_user" placeholder="Search"> 
          </div>
          <div class="col-4 logged_menu_right">
            <?php
              if(Auth::user()->profile_picture==''){
                $user_profile_picture = "placeholder.jpg";
              }else{
                $user_profile_picture = Auth::user()->profile_picture;
              }
              $slug = Auth::user()->slug;
            ?>
            <a href="#"><img src="{{ asset('new-theme/images/notification.png') }}" class="img img-responsive" alt="menu" /></a>
            <a href="{{ route('user.profile',['slug'=>$slug]) }}"><img src="<?php echo asset('uploads/user-pic/'.$user_profile_picture); ?>" style="height:40px;" class="img img-responsive" alt="headshot" /></a>
            <div class="dropdown" >
              <button class="dropbtn"><img src="{{ asset('new-theme/images/logged_menu.png') }}" style="height:25px;" class="img img-responsive" alt="menu" /></button>
              <div class="dropdown-content">
                <div class="">
                  <div class="arrow-up"></div>
                </div>
                <a href="#">Top 100</a>
                <a href="#">Add Hackathon</a>
                <a href="#">Setting & Privacy</a>
                <a href="#">Edit Profile</a><hr />
                <a style="padding-top:0px;padding-bottom:20px;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
              </div>
            </div>
           
          </div>
        </div>
    </div>
  </div>
</div>
</div>