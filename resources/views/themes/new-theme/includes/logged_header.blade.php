@php
  $user = Auth::user();
@endphp
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
                  @if($user->count())
                  <div class="col-md-12">
                    <p class="recent-search-title">Recent</p>
                    @foreach($user->recent_searches as $recent_search)
                    <a href="{{route('user.search.index')}}?q={{$recent_search->search_query}}" class="recent-search">{{$recent_search->search_query}}</a>
                    @endforeach
                  </div>
                  <hr />
                  @endif
                  <div class="row">
                    <div class="col-md-12">
                      <div class="search_area_html">
                        <p>Start searching with name or email</p>
                        <div class="close_btn_sec">
                          <a href="#" class="close_btn">Close Search Result</a>
                        </div>
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
                    $user_profile_picture = asset(Auth::user()->profile_picture);
                }else{
                    $user_profile_picture =  Auth::user()->profile_picture;
                }
              }
              $slug = Auth::user()->slug;
            ?>
            <a href="#"><img src="{{ asset('new-theme/images/notification.svg') }}" class="img img-responsive" alt="menu" /></a>
            <a href="{{ route('user.profile',$user->slug) }}"><img src="<?php echo $user_profile_picture; ?>" style="height:40px;" class="img img-responsive" alt="headshot" /></a>
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
                    <input type="checkbox" name="dark_mode_input" class="dark_mode_input" 
                    @if($isLoggedin && $loggedUser->theme=='dark') checked="checked" 
                    @elseif($isLoggedin && empty($loggedUser->theme)) checked="checked" 
                    @endif>
                    <span class="slider round"></span>
                  </label>
                </div>
                <a class="dropdown-item" href="{{ route('user.top.hackers') }}">Top 100</a>
                <a class="dropdown-item add_hackathon" href="javascript:void(0)">Add Hackathon</a>
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
                $user_profile_picture = asset(Auth::user()->profile_picture);
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
                <input type="checkbox" name="dark_mode_input" class="dark_mode_input" @if(!empty($loggedUser) && $loggedUser->theme=='dark') checked @elseif(empty($loggedUser)) checked @endif>
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

<div class="modal fade" id="select_theme" tabindex="-1" role="dialog" aria-labelledby="select_themeLabel" aria-hidden="true" align="center">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="new_modal_section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="new_modal_header">
                <button type="button" class="btn-close new_modal_close_btn" data-dismiss="modal" aria-label="Close">
                  <img alt="" src="{{asset('new-theme/images/icon_close.png')}}"></button>
                <h2 class="new_modal_header_title">Select Theme</h2>
              </div>
              <hr />
            </div>
            <div class="col-md-12 select_theme_container" style="height:300px;">
              <div class="container">
                <div class="row d-flex justify-content-center">
                  <a href="{{route('user.select_theme','dark')}}" class="dark_mode">Dark Mode</a>
                  <a href="{{route('user.select_theme','light')}}" class="light_mode">Light Mode</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var searchElement = document.getElementById("searchUser");
  searchElement.addEventListener("keyup", function(event) {
    var token = $("input[name=_token]").val();
    var name = searchElement.value;
    
    //send to detail search page on hitting enter key
    if (event.keyCode === 13) {
      store_recent_search('{{route('user.search.index')}}?q='+name);
    } else {
      $.ajax({
        type: 'POST',
        url: "{{route("user.search_users_ajax")}}",
        data: {_token: token, name: name},
        dataType: 'JSON',
        success: function (resp) {
          if(resp.html) {
            $('.search_area_html').html(resp.html)
          }
        },
      });
    }
  });
</script>