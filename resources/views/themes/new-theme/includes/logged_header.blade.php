@php
  $user = Auth::user();
  $badges = App\Badge::whereIn('id',[1,2,3,12])->get();
@endphp
<div id="header" class="top-bar-admin">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-5 logo only-desktop hide-in-tab">
        <a href="{{ url('/') }}">
          <img alt="Hack4 Pizza" src="{{asset('new-theme/images/logo.svg') }}" />
        </a>
      </div>
      <div class="col-6 offset-1 only-desktop hide-in-tab login_wrapper">
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
                <a class="dropdown-item edit-profile-icon" href="javascript:void(0)">Edit Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
              </div>
            </div>           
          </div>
        </div>
      </div>
      <div class="col-3 logo only-mobile show-in-tab">
        <a href="{{ url('/') }}">
          <img alt="Hack4 Pizza" src="{{asset('new-theme/images/logo.svg') }}" />
        </a>
      </div>
      <div class="col-9 logged_menu_right only-mobile show-in-tab">
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
        <a href="{{ route('user.profile',$loggedUserSlug) }}"><img src="<?php echo $user_profile_picture; ?>" style="height:40px;" class="img img-responsive" alt="headshot" /></a>
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
            <a class="dropdown-item add_hackathon" href="javascript:void(0)">Add Hackathon</a>
            <a class="dropdown-item" href="#">Setting & Privacy</a>
            <a class="dropdown-item edit-profile-icon" href="javascript:void(0)">Edit Profile</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
          </div>
        </div>    
      </div>
  </div>
</div>
</div>

<div class="modal fade" id="select_theme" tabindex="-1" role="dialog" aria-labelledby="select_themeLabel" aria-hidden="true" align="center">
  <div class="modal-dialog modal-lg">
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

<!-- profile edit modal -->
<div class="modal fade" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="performance_modelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="new_modal_section">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="new_modal_header">
                  <button type="button" class="btn-close new_modal_close_btn" data-dismiss="modal" aria-label="Close">
                  <img alt="" src="{{asset('new-theme/images/icon_close.png')}}"></button>
                  <h2 class="new_modal_header_title">Edit Profile</h2>
                </div>
                <hr />
              </div>
            </div>
            <form class="profile_save" id="update_user_profile_form" method="post" enctype="multipart/form-data">
              <div class="form-group msg_name">
                @csrf
                <label>Name*</label>
                <input type="hidden" id="id" value="{{$user->id}}">
                <input type="text" name="name" class="form-control" value="<?php echo $user->name;?>" id="name">
              </div>
              <div class="form-group">
                <label>Bio</label>
                <textarea name="bio" id="bio" class="form-control">{{$user->bio}}</textarea>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Upload Headshot</label>
                  <div class="custom-file">
                    <input type="file" name="pic" id="pic" class="custom-file-input">
                    <label class="custom-file-label" for="hackathon_img"></label>
                  </div>
                </div>
                <div class="form-group col-sm-3 pic_msg">
                  <?php
                    if($user->profile_picture!=null){
                      $user_headshot = asset($user->profile_picture);
                    }else{
                      $user_headshot = asset('uploads/user-pic/placeholder.jpg');
                    }
                  ?>
                  <img src="{{ $user_headshot }}" class="edit_headshot img img-thumbnail" style="width:150px;" alt="">
                </div>
              </div>
              <div class="form-group">
                <div class="userBox"></div>
              </div>
              <div class="form-group text-right ">
                <button type="button" id="profile_submit"  class="btn form_submit_btn">SAVE PROFILE</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- add hackathon modal -->
  <div class="modal fade" id="hackathon_add" tabindex="-1" role="dialog" aria-labelledby="hackathon_addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="new_modal_section">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="new_modal_header">
                  <button type="button" class="btn-close new_modal_close_btn" data-dismiss="modal" aria-label="Close">
                    <img alt="" src="{{asset('new-theme/images/icon_close.png')}}"></button>
                  <h2 class="new_modal_header_title">Add Hackathon</h2>
                </div>
                <hr />
              </div>
            </div>
          </div>
          <form id="hackathon_add_form" class="form_class add_hackathon_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="ha_pic" >
            <div class="form-group">
              <input type="text" placeholder="Hackathon's name*" class="form-control hackathon_input" name="name" id="ha_name">
            </div>
            <div class="form-group ha_organized">
              <input type="text" class="form-control hackathon_input" placeholder="Hosted/Organized by*" name="organized_by" id="ha_organized">
            </div>
            <div class="form-row">
              <div class="form-group col-md-4 ha_from">
                <input type="text" placeholder="From*" class="form-control datepicker datepicker_from hackathon_input " name="from" id="ha_from">
              </div>
              <div class="form-group col-md-4">
                <input type="text" placeholder="To*" class="form-control datepicker datepicker_to hackathon_input" name="to" id="ha_to">
              </div>
              <div class="form-group col-md-4 place_msg">
                <select class="form-control hackathon_input" name="result" id="ha_result">
                  <option value="" selected>Select Result*</option>
                  @foreach($badges as $badge)
                    <?php
                      if($badge->id==12){
                        $badge_name = "Didn't win";
                      }else{
                        $badge_name = $badge->name;
                      }
                    ?>
                    <option value="{{$badge->id}}">{{ $badge_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="ha_description" class="hackathon_input_label">Description (HTML editor)*</label>
              <textarea class="form-control hackathon_input_textarea" rows="5" name="description" id="ha_description"></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="hackathon_input_label">Upload Hackathon's logo/IMG</label>
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input new_hackathon_img hackathon_input " id="new_hackathon_img">
                  <label class="custom-file-label add_hackathon_file_label" for="hackathon_img"></label>
                </div>
              </div>
              
              <div class="form-group col-sm-2 ha_pic_msg display_new_hackathon_img">
                <label for="new_hackathon_img">
                <img style="width:100px;" src="{{ asset('new-theme/images/logo.svg') }}">
                </label>
              </div>
            </div>
            <div class="form-group text-right ha_success">
            </div>
            <div class="form-group text-right">
              <button type="button" id="ha_submit" class="btn add_hackathon_submit_btn">SAVE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


