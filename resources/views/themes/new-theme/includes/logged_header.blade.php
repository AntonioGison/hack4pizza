<div id="header" class="top-bar-admin">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-5 logo only-desktop">
        <a href="{{ url('/') }}">
          <img alt="Hack4 Pizza" src="{{asset('new-theme/images/logo.svg') }}" />
        </a>
      </div>
      <div class="col-6 offset-1 only-desktop login_wrapper">
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        <div class="row">
          <div class="col-8 less-padding">
            <div class="dropdown_search">
              <input type="text" id="searchUser" class="form-control search_user" placeholder="Search"> 
              <div class="search_area_content only-desktop">
                <div class="arrow-up-white"></div>
                <div class="search_area">
                  <div class="search_result_number">
                    About <span class="number_search">35</span> Results
                  </div>
                  <div class="row justify-content-md-center" >
                    <div class="col-md-3">
                      <div class="user_search_box">
                        <img src="{{ asset('uploads/user-pic/search1.png') }}" alt="User" class="img img-responsive">
                        <div class="user_name"><h4>Rick Jones</h4></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="user_search_box">
                        <img src="{{ asset('uploads/user-pic/search2.png') }}" alt="User" class="img img-responsive">
                        <div class="user_name"><h4>Rick Brando</h4></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="user_search_box">
                        <img src="{{ asset('uploads/user-pic/search3.png') }}" alt="User" class="img img-responsive">
                        <div class="user_name"><h4>Rick Smith</h4></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="user_search_box">
                        <img src="{{ asset('uploads/user-pic/search4.png') }}" alt="User" class="img img-responsive">
                        <div class="user_name"><h4>Rick Saurez</h4></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="user_search_box">
                        <img src="{{ asset('uploads/user-pic/search5.png') }}" alt="User" class="img img-responsive">
                        <div class="user_name"><h4>Rick James</h4></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="user_search_box">
                        <img src="{{ asset('uploads/user-pic/search1.png') }}" alt="User" class="img img-responsive">
                        <div class="user_name"><h4>Rick Jones</h4></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="user_search_box">
                        <img src="{{ asset('uploads/user-pic/search2.png') }}" alt="User" class="img img-responsive">
                        <div class="user_name"><h4>Rick Brando</h4></div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="user_search_box">
                        <a href="{{ route('user.search.index') }}">
                          <img src="{{ asset('uploads/see_all.png') }}" alt="User" class="img img-responsive">
                          <div class="user_name"><h4>See All</h4></div>
                        </a>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="close_btn_sec">
                        <a href="#" class="close_btn">Close Search Result</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 logged_menu_right">
            <?php
              if(Auth::user()->profile_picture==''){
                $user_profile_picture = Storage::url("uploads/user-pic/placeholder.jpg");
              }else{
                if(Auth::user()->facebook_id=='' && 
                  Auth::user()->linked_id=='' && 
                  Auth::user()->github_id==''){
                    $user_profile_picture = Storage::url(Auth::user()->profile_picture);
                }else{
                    $user_profile_picture =  Auth::user()->profile_picture;
                }
              }
              $slug = Auth::user()->slug;
            ?>
            <a href="#"><img src="{{ asset('new-theme/images/notification.svg') }}" class="img img-responsive" alt="menu" /></a>
            <a href="{{ route('user.dashboard') }}"><img src="<?php echo $user_profile_picture; ?>" style="height:40px;" class="img img-responsive" alt="headshot" /></a>
            <div class="dropdown my-dropdown">
              <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('new-theme/images/logged_menu.svg') }}" style="height:25px;" class="img img-responsive" alt="menu" />
              </button>
              <div class="dropdown-menu dropdown-content dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <div class="">
                  <div class="arrow-up"></div>
                </div>
                <div class="dark_mode_switch">
                  Dark Mode
                  <label class="switch">
                    <input type="checkbox" name="dark_mode_input" class="dark_mode_input" checked>
                    <span class="slider round"></span>
                  </label>
                </div>
                <a class="dropdown-item" href="{{ route('user.top.hackers') }}">Top 100</a>
                <a class="dropdown-item" href="#">Add Hackathon</a>
                <a class="dropdown-item" href="#">Setting & Privacy</a>
                <a class="dropdown-item" href="#">Edit Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
              </div>
            </div>           
          </div>
        </div>
      </div>
      <div class="col-3 logo only-mobile">
        <a href="{{ url('/') }}">
          <img alt="Hack4 Pizza" src="{{asset('new-theme/images/logo.svg') }}" />
        </a>
      </div>
      <div class="col-9 logged_menu_right only-mobile">
        <?php
          if(Auth::user()->profile_picture==''){
            $user_profile_picture = Storage::url("uploads/user-pic/placeholder.jpg");
          }else{
            if(Auth::user()->facebook_id=='' && 
              Auth::user()->linked_id=='' && 
              Auth::user()->github_id==''){
                $user_profile_picture = Storage::url(Auth::user()->profile_picture);
            }else{
                $user_profile_picture =  Auth::user()->profile_picture;
            }
          }
          $slug = Auth::user()->slug;
        ?>
        <a href="#"><img src="{{ asset('new-theme/images/notification.svg') }}" class="img img-responsive" alt="menu" /></a>
        <a href="{{ route('user.dashboard') }}"><img src="<?php echo $user_profile_picture; ?>" style="height:40px;" class="img img-responsive" alt="headshot" /></a>
        <div class="dropdown my-dropdown">
          <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('new-theme/images/logged_menu.svg') }}" style="height:25px;" class="img img-responsive" alt="menu" />
          </button>
          <div class="dropdown-menu dropdown-content dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <div class="">
              <div class="arrow-up"></div>
            </div>
            <div class="dark_mode_switch">
              Dark Mode
              <label class="switch">
                <input type="checkbox" name="dark_mode_input" class="dark_mode_input" checked>
                <span class="slider round"></span>
              </label>
            </div>
            <a class="dropdown-item" href="{{ route('user.search.index') }}">Search Users</a>
            <a class="dropdown-item" href="{{ route('user.top.hackers') }}">Top 100</a>
            <a class="dropdown-item" href="#">Add Hackathon</a>
            <a class="dropdown-item" href="#">Setting & Privacy</a>
            <a class="dropdown-item" href="#">Edit Profile</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
          </div>
        </div>    
      </div>
  </div>
</div>
</div>