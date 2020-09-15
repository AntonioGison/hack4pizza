@extends('themes.new-theme.app')
@section('additional_css')
  <link href="{{ asset('theme/hack4pizza/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('new-theme/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
  @if($user->theme == 'light')
    <style>
      :root {
        --very-dark-bg: #09062A;
        --light-color : #333333;
        --dark-bg: #f3f3f3;
        --dark-blue: #ffffff;
      }
    </style>
  @else
    <style>
      :root {
        --very-dark-bg: #09062A;
        --light-color : #ffffff;
        --dark-bg: #25215A;
        --dark-blue: #3B3677;
      }
    </style>
  @endif
@endsection
@section('content')
<div class="dashboard_body">
  <div id="main_info">
    <?php
      $badges = \App\Badge::all();
      $m_badges = \App\MasterBadge::all();
      $max = (date("Y",strtotime($user->experiences->max("from"))));
      $min =(date("Y",strtotime($user->experiences->min("from"))));

      // Extracting user data.
      $full_name = $user->name;
      $address = $user->address;
      $bio = $user->bio;
      $slug = $user->slug;
      $user_profile_picture = $user->profile_picture;
      
      if($user_profile_picture==''){
        $profile_picture = asset('uploads/user-pic/placeholder.jpg');
      }else{
        if($user->facebook_id=='' && 
          $user->linked_id=='' && 
          $user->github_id==''){
            $profile_picture = Storage::url($user_profile_picture);
        }else{
            $profile_picture =  $user_profile_picture;
        }
      }

      $member_since =(date("Y",strtotime($user->created_at)));

      if($address==''){
        $address = "Address not available.";
      }
      
      if($bio ==''){
        $bio = "Biography not available.";
      }
    ?>
    <div class="container">
      @if(Session::has('success_message'))
        <div class="alert alert-success">
          {{ Session::get('success_message') }}
        </div>
      @endif
      <div class="row">
        <div class="col main_info_wraper dashboard_first_block dashboard_block">
          <div class="row relative">
            <div class="col-4 col-md-3 main_info_cover text-center">
              <a href="#">
                <figure class="figure">
                    <img src="<?php echo $profile_picture; ?>" class="figure-img img-fluid user_headshot" alt="cover">
                </figure>
              </a>
            </div>
            <div class="col-8 col-md-5 basic_info_block">
              <h2>{{ $full_name }} <img src="{{ asset('new-theme/images/verified_user.png') }}" alt="verified" /></h2>
              <p><i class="fa fa-map-marker-alt"></i> &nbsp;{{ $address }}</p>
              <p><i class="fa fa-user"></i> &nbsp;Member Since {{ $member_since }} </p>
            </div>
            <div class="col-12 only-mobile"><hr /></div>
            <div class="col-12 col-md-4 main_info_links">
              <div class="share_block">
                <a href="#"><i class="fab fa-facebook-f"></i> &nbsp;Share</a>
                <a href="#"><i class="fab fa-linkedin-in"></i>&nbsp;Share</a>
                <a href="#"><i class="fa fa-copy"></i> &nbsp;Copy</a>
              </div>
            </div>
            <div class="col-12 only-mobile"><hr /></div>
            <div class="col-12 col-md-6">
              <div class="bio_info">
                <h2>Biography</h2>
                <p><?php echo $bio ?></p>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="bio_info social_media_info">
                <h2>Social</h2>
                <a href="#">
                  <img src="{{ asset('new-theme/images/link_instagram.svg') }}" alt="instagram" />
                </a>
                <a href="#">
                  <img src="{{ asset('new-theme/images/link_facebook.svg') }}" alt="facebook" />
                </a>
                <a href="#">
                  <img src="{{ asset('new-theme/images/link_dribbble.svg') }}" alt="dribbble" />
                </a>
                <a href="#">
                  <img src="{{ asset('new-theme/images/link_behance.svg') }}" alt="behance" />
                </a>
                <a href="#">
                  <img src="{{ asset('new-theme/images/link_whatsapp.svg') }}" alt="whatsapp" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="performance-badges">
    <div class="container">
      <div class="row">
        <div class="col-md-6 performance">
          <div class="performance_block">
            <h2 class="performance_block_title">Performance</h2>
            <hr />
            <div class="row align-items-center justify-content-center badge-min-height">
              <div class="col-12 text-center">
                <div id="chartjs-radar">
                  <canvas id="canvas"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 badges">
          <div class="badge_block">
            <h2 class="badge_block_title">Badges</h2>
            <hr />
            <div class="row justify-content-center">
              <?php 
              $i=0;
              foreach($badges as $badge){
                $i++;
                if($i<9){
              ?>
              <div class="col-4 col-md-3 p-0 badge_section">
                <div class="badge_box">
                  <div class="badge_name_sec">
                    <div class="badge_name">{{ $badge->name }}</div>
                  </div>
                  <div class="badge_image_sec">
                    <img class="badge_image" src="{{ Storage::url($badge->pic) }}" alt="Badge">
                  </div>
                  <div class="badge_count">x1</div>
                </div>
              </div>
              <?php }} ?>
            </div>
            <div class="row justify-content-center">
              <a href="#" class="see_all see_all_badges">See all</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  if($user->performance){
    $perf = [];
    $perf['pitch']=$user->performance->pitch;
    $perf['front_end']=$user->performance->front_end;
    $perf['back_end']=$user->performance->back_end;
    $perf['team_player']=$user->performance->team_player;
    $perf['problem_solving']=$user->performance->problem_solving;
    $perf['ux_design']=$user->performance->ux_design;
    
    $max_skill_key= array_keys($perf,max($perf));
    $max_skill_key;
    $max_skill = $perf[$max_skill_key[0]];
  }else{
    $max_skill=10;
  }
  ?>
  <div class="hackathon_sections">
    <div class="container">
      <div class="row">
        <div class="col no-padding">
          <?php 
          $sn=0;
          $ik = 0;
          for ($i = $max; $i >= $min; $i--){
            $sn++;
            $ik++;
            if($ik==1){
              $btn_style = "background-color:#00F9FF; color:#000";
            }else if($ik==2){
              $btn_style = "background-color:#FFBE06; color:#000"; 
            }else if($ik==3){
              $btn_style = "background-color:#D90088; color:#fff";
            }else{
              $ik=2;
              $btn_style = "background-color:#00F9FF; color:#000";
            }
            //finding year
            $experiences = \App\Experience::where("user_id",$user->id)->whereYear("from",$i)->orderBy('from','desc')->get();
          ?>
          @if(($experiences->isNotEmpty() or $sn==1) && count($experiences)>0)
            @if($sn == 1)
              <div class="hackathon_section">
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="block-title" style="<?php echo $btn_style ?>">@if($i == "1970"){{date("Y")}}@else{{$i}}@endif</h2>
                  </div>
                  <div class="col-md-12 hackathon_header">
                    @if(isset($ownprofile) && $ownprofile)
                    <a href="#" class="add_hackathon float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Hackathon</a>
                    @endif
                    <h3>HACKATHONS</h3>
                    <hr class="hr-white"/>
                  </div>
                  <div class="col-md-12 hackathon_data_section">
                    @foreach($experiences as $key => $experience)
                      @if($key < 1)
                      <div class="hackathon_data">
                        <div class="container">
                          <div class="row">
                            <div class="col-2 col-md-1 hackathon_thumbnail">
                              <img class="img img-responsive" src="{{ Storage::url($experience->pic) }}" alt="hackathon_logo">
                            </div>
                            <div class="col-9 col-md-11">
                              <a href="#" class="hackathon_share_btn only-desktop float-right share_hackathon"><img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">&nbsp;Share</a>
                              <h4>{{ $experience->name }}</h4>
                              <h5>By {{ $experience->organized_by }} <br /> {{ Date('d-M-Y',strtotime($experience->from)) }} - {{ Date('d-M-Y',strtotime($experience->to)) }}</h5>
                              <p class="only-desktop"><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                              <img src="{{ Storage::url($experience->badge->pic) }}" class="hackathon_badge_img only-desktop" alt="badge information"><label class="hackathon_badge_title only-desktop">&nbsp;&nbsp;{{ $experience->badge->name }}</label>
                            </div>
                            <div class="col-2 only-mobile">
                              <a href="#" class="hackathon_share_btn only-mobile share_hackathon">
                                <img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">
                              </a>
                            </div>
                            <div class="col-10 only-mobile">
                              <p><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                              <img src="{{ Storage::url($experience->badge->pic) }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;{{ $experience->badge->name }}</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      @else
                      <div class="hackathon_data_{{$i}}" style="display:none;">
                        <div class="hackathon_data">
                          <div class="container">
                            <div class="row">
                              <div class="col-2 col-md-1 hackathon_thumbnail">
                                <img class="img img-responsive" src="{{ Storage::url($experience->pic) }}" alt="hackathon_logo">
                              </div>
                              <div class="col-9 col-md-11">
                                <a href="#" class="hackathon_share_btn only-desktop float-right share_hackathon"><img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">&nbsp;Share</a>
                                <h4>{{ $experience->name }}</h4>
                                <h5>By {{ $experience->organized_by }} <br /> {{ Date('d-M-Y',strtotime($experience->from)) }} - {{ Date('d-M-Y',strtotime($experience->to)) }}</h5>
                                <p class="only-desktop"><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                                <img src="{{ Storage::url($experience->badge->pic) }}" class="hackathon_badge_img only-desktop" alt="badge information"><label class="hackathon_badge_title only-desktop">&nbsp;&nbsp;{{ $experience->badge->name }}</label>
                              </div>
                              <div class="col-2 only-mobile">
                                <a href="#" class="hackathon_share_btn only-mobile share_hackathon">
                                  <img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">
                                </a>
                              </div>
                              <div class="col-10 only-mobile">
                                <p><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                                <img src="{{ Storage::url($experience->badge->pic) }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;{{ $experience->badge->name }}</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                    @endforeach
                    
                    @if(count($experiences) > 1)
                    <!-- <div class="col-md-12"> -->
                      <div class="row justify-content-center">
                        <a href="javascript:void(0);" class="see_all see_all_hackathon_btn_{{$i}}" onclick="seeAllHackathon('{{$i}}')">See all</a>
                      </div>
                    <!-- </div> -->
                    @endif

                  </div>
                </div>
              </div>
            @else
              <div class="hackathon_section">
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="block-title" style="<?php echo $btn_style ?>">{{ $i }}</h2>
                  </div>
                  <div class="col-md-12 hackathon_header">
                    @if(isset($ownprofile) && $ownprofile)
                    <a href="#" class="add_hackathon float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Hackathon</a>
                    @endif
                    <h3>HACKATHONS</h3>
                    <hr class="hr-white"/>
                  </div>
                  <div class="col-md-12 hackathon_data_section">
                    @foreach($experiences as $key => $experience)
                      @if($key < 1)
                      <div class="hackathon_data">
                        <div class="container">
                          <div class="row">
                            <div class="col-2 col-md-1 hackathon_thumbnail">
                              <img class="img img-responsive" src="{{ Storage::url($experience->pic) }}" alt="hackathon_logo">
                            </div>
                            <div class="col-9 col-md-11">
                              <a href="#" class="hackathon_share_btn only-desktop float-right share_hackathon"><img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">&nbsp;Share</a>
                              <h4>{{ $experience->name }}</h4>
                              <h5>By {{ $experience->organized_by }} <br /> {{ Date('d-M-Y',strtotime($experience->from)) }} - {{ Date('d-M-Y',strtotime($experience->to)) }}</h5>
                              <p class="only-desktop"><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                              <img src="{{ Storage::url($experience->badge->pic) }}" class="hackathon_badge_img only-desktop" alt="badge information"><label class="hackathon_badge_title only-desktop">&nbsp;&nbsp;{{ $experience->badge->name }}</label>
                            </div>
                            <div class="col-2 only-mobile">
                              <a href="#" class="hackathon_share_btn only-mobile share_hackathon">
                                <img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">
                              </a>
                            </div>
                            <div class="col-10 only-mobile">
                              <p><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                              <img src="{{ Storage::url($experience->badge->pic) }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;{{ $experience->badge->name }}</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      @else
                      <div class="hackathon_data_{{$i}}" style="display:none;">
                        <div class="hackathon_data">
                          <div class="container">
                            <div class="row">
                              <div class="col-2 col-md-1 hackathon_thumbnail">
                                <img class="img img-responsive" src="{{ Storage::url($experience->pic) }}" alt="hackathon_logo">
                              </div>
                              <div class="col-9 col-md-11">
                                <a href="#" class="hackathon_share_btn only-desktop float-right share_hackathon"><img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">&nbsp;Share</a>
                                <h4>{{ $experience->name }}</h4>
                                <h5>By {{ $experience->organized_by }} <br /> {{ Date('d-M-Y',strtotime($experience->from)) }} - {{ Date('d-M-Y',strtotime($experience->to)) }}</h5>
                                <p class="only-desktop"><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                                <img src="{{ Storage::url($experience->badge->pic) }}" class="hackathon_badge_img only-desktop" alt="badge information"><label class="hackathon_badge_title only-desktop">&nbsp;&nbsp;{{ $experience->badge->name }}</label>
                              </div>
                              <div class="col-2 only-mobile">
                                <a href="#" class="hackathon_share_btn only-mobile share_hackathon">
                                  <img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">
                                </a>
                              </div>
                              <div class="col-10 only-mobile">
                                <p><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                                <img src="{{ Storage::url($experience->badge->pic) }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;{{ $experience->badge->name }}</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                    @endforeach

                    @if(count($experiences) > 1)
                    <!-- <div class="col-md-12"> -->
                      <div class="row justify-content-center">
                        <a href="javascript:void(0);" class="see_all see_all_hackathon_btn_{{$i}}" onclick="seeAllHackathon('{{$i}}')">See all</a>
                      </div>
                    <!-- </div> -->
                    @endif
                  </div>
                </div>
              </div>
            @endif
          @endif
          <?php 
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('models')
  <div class="modal fade" id="profile_model" tabindex="-1" role="dialog" aria-labelledby="performance_modelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="block_wrapper">
          <h2 class="block-title">Edit Profile</h2>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
          <form id="profile_form" class="form_class" method="post" enctype="multipart/form-data">
            <div class="form-group msg_name">
              @csrf
              <input type="hidden" id="pic" value="{{$user->pic}}">
              <label>Name*</label>
              <input type="hidden" id="id" value="{{$user->id}}">
              <input type="text" name="name" class="form-control" value="<?php echo $user->name;?>" id="name">
            </div>
            <div class="form-group">
              <label>Bio</label>
              <textarea name="" id="bio"  class="form-control">{{$user->bio}}</textarea>
            </div>
            <div class="form-group msg_email">
              <label>Email*</label>
              <input type="email" class="form-control" id="email" value="{{$user->email}}">
            </div>
            <div class="form-group msg_pass">
              <label>Password</label>
              <input type="password" class="form-control" id="password" placeholder="If you didnt want to change Password leave it blank">
            </div>
            <div class="form-group">
              <label>Social Link Name</label>
              <input type="text" class="form-control" {{$user->name1}} id="name1">
            </div>
            <div class="form-group">
              <label>Url</label>
              <input type="text" class="form-control" {{$user->url1}} id="url1">
            </div>
            <div class="form-group">
              <label>Social Link Name</label>
              <input type="text" class="form-control" {{$user->name2}} id="name2">
            </div>
            <div class="form-group">
              <label>Url</label>
              <input type="text" class="form-control" {{$user->url2}} id="url2">
            </div>
            <div class="form-group">
              <label>Social Link Name</label>
              <input type="text" class="form-control" {{$user->name3}} id="name3">
            </div>
            <div class="form-group">
              <label>Url</label>
              <input type="text" class="form-control" {{$user->url3}} id="url3">
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Upload Hackathon's logo/IMG</label>
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input" id="{{asset('theme/hack4pizza/hackathon_img')}}">
                  <label class="custom-file-label" for="hackathon_img"></label>
                </div>
              </div>
              <div class="form-group col-sm-3 pic_msg">
                @if($user->pic != null)
                  <img src="{{asset("uploads/user-pic/$user->pic")}}" width="100%" alt="">
                @endif
              </div>
            </div>
            <div class="form-group text-right ">
              <button type="button" id="profile_submit"  class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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
              <input type="text" placeholder="Hackathon's name*" class="form-control hackathon_input" id="ha_name">
            </div>
            <div class="form-group ha_organized">
              <input type="text" class="form-control hackathon_input" placeholder="Hosted/Organized by*" id="ha_organized">
            </div>
            <div class="form-row">
              <div class="form-group col-md-4 ha_from">
                <input type="text" placeholder="From*" class="form-control datepicker hackathon_input " id="ha_from">
              </div>
              <div class="form-group col-md-4">
                <input type="text" placeholder="To*" class="form-control datepicker hackathon_input" id="ha_to">
              </div>
              <div class="form-group col-md-4 place_msg">
                <select class="form-control hackathon_input" id="ha_result">
                  <option value="" selected>Select Result*</option>
                  @foreach($badges as $badge)
                    <option value="{{$badge->id}}">{{$badge->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="ha_description" class="hackathon_input_label">Description (HTML editor)*</label>
              <textarea class="form-control hackathon_input_textarea" rows="5" id="ha_description"></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="hackathon_input_label">Upload Hackathon's logo/IMG</label>
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input hackathon_input" id="new_hackathon_img">
                  <label class="custom-file-label add_hackathon_file_label" for="hackathon_img"></label>
                </div>

              </div>
              <div class="form-group col-sm-2 ha_pic_msg">

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

  <div class="modal fade" id="hackathon_share" tabindex="-1" role="dialog" aria-labelledby="hackathon_shareLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="new_modal_section">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="new_modal_header">
                  <button type="button" class="btn-close new_modal_close_btn" data-dismiss="modal" aria-label="Close">
                    <img alt="" src="{{asset('new-theme/images/icon_close.png')}}"></button>
                  <h2 class="new_modal_header_title">Share</h2>
                </div>
                <hr />
              </div>
              <div class="col-md-12">
                <div class="share_pop_social_media_links">
                  <a href="#">
                    <img src="{{ asset('new-theme/images/link_instagram.svg') }}" alt="instagram" />
                  </a>
                  <a href="#">
                    <img src="{{ asset('new-theme/images/link_facebook.svg') }}" alt="facebook" />
                  </a>
                  <a href="#">
                    <img src="{{ asset('new-theme/images/link_dribbble.svg') }}" alt="dribbble" />
                  </a>
                  <a href="#">
                    <img src="{{ asset('new-theme/images/link_behance.svg') }}" alt="behance" />
                  </a>
                  <a href="#">
                    <img src="{{ asset('new-theme/images/link_whatsapp.svg') }}" alt="whatsapp" />
                  </a>
                </div>
                <div class="copy_section col-md-9 col-12">
                  <div class="row">
                    <div class="col-md-9 col-9">
                      <span>
                        <?php echo url('/')."user/".$slug; ?>
                      </span>
                    </div>
                    <div class="col-md-3 col-3">
                      <span class="float-right">
                        <i class="fa fa-copy"></i>&nbsp;Copy</div>
                      </span>  
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="performance_model" tabindex="-1" role="dialog" aria-labelledby="performance_modelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="block_wrapper">
          <h2 class="block-title">Edit Performance</h2>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
          <form id="performance_form" class="form_class">
            <div class="form-group">
              <input type="hidden" id="per_id" value="{{$user->performance->id or ''}}">
              <label>Pitch Presentation</label>
              <input type="number" value="{{$user->performance->pitch or '0'}}" class="form-control" id="pitch">
            </div>
            <div class="form-group">
              <label>Front End*</label>
              <input type="number" class="form-control" value="{{$user->performance->front_end or '0'}}" id="front_end">
            </div>
            <div class="form-group">
              <label>Back End*</label>
              <input type="number" class="form-control" value="{{$user->performance->back_end or '0'}}" id="back_end">
            </div>
            <div class="form-group">
              <label>Team player*</label>
              <input type="number" class="form-control" value="{{$user->performance->team_player or '0'}}" id="team_player">
            </div>
            <div class="form-group">
              <label>Problem Solving*</label>
              <input type="number" class="form-control" value="{{$user->performance->problem_solving or '0'}}" id="problem_solving">
            </div>
            <div class="form-group">
              <label>UX Design*</label>
              <input type="number" class="form-control"  value="{{$user->performance->ux_design or '0'}}" id="ux_design">
            </div>
            <div class="form-group per_success">
            </div>
            <div class="form-group text-right">
              <button type="button" id="per_submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="all_badges" tabindex="-1" role="dialog" aria-labelledby="all_badgesLabel" aria-hidden="true" align="center">
    <div class="modal-dialog modal-lg2">
      <div class="modal-content">
        <div class="new_modal_section">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="new_modal_header">
                  <button type="button" class="btn-close new_modal_close_btn" data-dismiss="modal" aria-label="Close">
                    <img alt="" src="{{asset('new-theme/images/icon_close.png')}}"></button>
                  <h2 class="new_modal_header_title">Badges</h2>
                </div>
                <hr />
              </div>
              <div class="col-md-12 badges_container" style="height:600px;">
                <div class="container">
                  <div class="row">
                    <?php
                    foreach($badges as $badge){
                    ?>
                    <div class="col-4 col-md-2 p-0 badge_section">
                      <div class="badge_box">
                        <div class="badge_name_sec">
                          <div class="badge_name">{{ $badge->name }}</div>
                        </div>
                        <div class="badge_image_sec">
                          <img class="badge_image" src="{{ Storage::url($badge->pic) }}" alt="Badge">
                        </div>
                        <div class="badge_count">x1</div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section("additional_js")
  <script src="{{ asset('theme/hack4pizza/js/Chart.min.js')}}"></script>
  <script src="{{ asset('theme/hack4pizza/js/moment.min.js')}}"></script>
  <script src="{{ asset('theme/hack4pizza/js/bootstrap-datetimepicker.min.js')}}"></script>
  <script src="{{asset('new-theme/plugins/sweetalert/js/sweetalert.min.js')}}"></script>
  <script>
    /**  Show Radar Chart  **/
    function del(id){
      swal({
          title: "Are you sure?",
          text: "This Hackthon will be deleted permanently",
          type: "error",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
          var APP_URL = {!! json_encode(url('/')) !!}
            window.location.href = APP_URL+"/hackonthon-delete/delete/"+id;
        });

    }
    window.chartColors = {
      red: 'rgb(244, 132, 70)'
    };

    var color = Chart.helpers.color;
    var config = {
      type: 'radar',
      data: {
        labels: [
          "PITCH PRESENTATION ", 
          "FRONT END ", 
          "BACK END ", 
          "TEAM PLAYER ", 
          "PROBLEM SOLVING ", 
          "UX DESIGN "
        ],
        datasets: [{
          label: 'Performance',
          backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
          borderColor: window.chartColors.red,
          pointBackgroundColor: window.chartColors.red,
          data: [
            {{$user->performance->pitch or '0'}},
            {{$user->performance->front_end or '0'}},
            {{$user->performance->back_end or '0'}},
            {{$user->performance->team_player or '0'}},
            {{$user->performance->problem_solving or '0'}},
            {{$user->performance->ux_design or '0'}}
          ],
          notes: ["none", "none", "none", "none", "none", "none"]
        }]
      },
      options: {
        legend: {
          display: false,
        },
        title: {
          display: true,
          padding:20,
        },
        scale: {
          gridLines: {
            color: '#ffffff'
          },
          angleLines: {
            color: '#ffffff'
          },
          ticks: {
            fontColor:'#ffffff',
            backdropColor:'transparent',
            stepSize:2,
            min:0,
            max:10,
            fontFamily:'Monument',
            fontSize:12,
            beginAtZero: true
          },
          pointLabels: {
            fontColor: '#00F9FF',
            fontSize: 14,
            fontFamily:'Monument',
          },
          Axes: [{
            display: false, //this will remove all the x-axis grid lines
          }]
        }
      }
    };
    window.onload = function() {
      window.myRadar = new Chart(document.getElementById("canvas"), config);
    };
    var colorNames = Object.keys(window.chartColors);

    $(function() {
      // pop up by default;
      // $("#hackathon_add").modal();

      // Display Badges Modal
      $(".see_all_badges").click(function(e){
        e.preventDefault();
        $("#all_badges").modal();
      });

      // Display Add Hackathon Modal
      $(".add_hackathon").click(function(e){
        e.preventDefault();
        $("#hackathon_add").modal();
      });

      // Display share pop up for each hackathon
      $(".share_hackathon").click(function(e){
        e.preventDefault();
        $("#hackathon_share").modal();

      });
      /** Show Hide Hackathon blocks **/
      $('#hackathon_blocks_2018').on('show.bs.collapse', function() {
        $('#hackathon_winBadges_2018').hide();
      });
      $('#hackathon_blocks_2018').on('hide.bs.collapse', function() {
        $('#hackathon_winBadges_2018').show();
      });

      /** Get Selected File name fileinput **/
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

      /** datetimepicker **/
      $('.datepicker').datetimepicker({
        format: 'D/M/YYYY',
        widgetPositioning: {
          horizontal: "auto",
          vertical: "bottom"
        }
      });

    });
    $(".year_show").click(function () {
      $(this).parent().find(".hackathon_winBadges").toggle();
    });
    $(".hackathon_winBadges").click(function () {
       $(this).hide();
       $(this).parent().parent().find(".collapse").addClass("show");
    });
    $('#hackathon_add_form').on('change','.custom-file-input', function(event){
      $.LoadingOverlay("show");
      var form = $('form#hackathon_add_form')[0];
      event.preventDefault();
      $.ajax({
        url:"{{ route('ajaxuploadhackon.action') }}",
        method:"POST",
        data:new FormData(form),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
          $.LoadingOverlay("hide");
          $(".ha_pic_msg").children().remove();
          $("#ha_pic").val(data.pic);

          if (data.pic == ""){
            $('<span class="umsg">' + data.massage + '</span>').appendTo(".ha_pic_msg").css('color', 'red');
          }else{
            $(".ha_pic_msg").append(data.uploaded_image);
          }
          // $('#message').css('display', 'block');
          // $('#message').html(data.message);
          // $('#message').addClass(data.class_name);
          // $('#uploaded_image').html(data.uploaded_image);
        }
      })
    });
    $("#ha_submit").click(function () {
      $.LoadingOverlay("show");
      $("#hackathon_add").find('.emsg').remove();
      var token = $("input[name=_token]").val();
      var name = $("#ha_name").val();
      var organized_by = $("#ha_organized").val();
      var from = $("#ha_from").val();
      var to = $("#ha_to").val();
      var result = $("#ha_result").val();
      var description = $("#ha_description").val();
      var pic = $("#ha_pic").val();
      $.ajax({
        type: 'POST',
        url: "{{route("add-hackonton")}}",
        data: {_token: token, name: name, organized_by: organized_by, from: from, to: to, result: result, description: description, pic: pic},
        dataType: 'JSON',
        success: function (resp) {
          $.LoadingOverlay("hide");
          if (resp.status == 0) {
            $('<span class="emsg">Congrats..Your Hackonton has been Added!</span>').appendTo(".ha_success").css('color', 'green');
            var delay = 1000; //Your delay in milliseconds
            setTimeout(function () {
              window.location = '/user/dashboard';
            }, delay);
          } else {
            if (typeof resp.name != "undefined") {
              $("#ha_name").parent().append('<span class="emsg">' + resp.name + '</span>').css('color', 'red');
            }
            if (typeof resp.description != "undefined") {
              $("#ha_description").parent().append('<span class="emsg">' + resp.description + '</span>').css('color', 'red');
            }
            if (typeof resp.result != "undefined") {
              $("#ha_result").parent().append('<span class="emsg">' + resp.result + '</span>').css('color', 'red');
            }
            if (typeof resp.from != "undefined") {
              $("#ha_from").parent().append('<span class="emsg">' + resp.from + '</span>').css('color', 'red');
            }
            if (typeof resp.to != "undefined") {
              $("#ha_to").parent().append('<span class="emsg">' + resp.to + '</span>').css('color', 'red');
            }
            if (typeof resp.organized_by != "undefined") {
              $("#ha_organized").parent().append('<span class="emsg">' + resp.organized_by + '</span>').css('color', 'red');
            }


          }

        },

      });
    });
    //see all hackathon function
    function seeAllHackathon(key) {
      var moreText = $(".hackathon_data_"+key);
      var btnText = $(".see_all_hackathon_btn_"+key);
      console.log(moreText);
        
      if(moreText.css('display') == 'none') {
        moreText.css("display", "block");
        btnText.text("See less");
      } else {
        moreText.css("display", "none");
        btnText.text("See all");
      }
    }
  </script>
@endsection
