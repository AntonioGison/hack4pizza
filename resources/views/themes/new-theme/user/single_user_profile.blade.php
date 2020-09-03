@extends('themes.new-theme.app')
@section('additional_css')
  <link href="{{ asset('theme/hack4pizza/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('new-theme/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
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
            $profile_picture = asset('uploads/user-pic/'.$user_profile_picture);
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
              <div class="col-4 col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" alt="Badge">
              </div>
              <div class="col-4 col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/place_3.svg') }}" alt="Badge">
              </div>
              <div class="col-4 col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/taste_4_gold.svg') }}" alt="Badge">
              </div>
              <div class="col-4 col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/here_4_pizza.svg') }}" alt="Badge">
              </div>
              <div class="col-4 col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" alt="Badge">
              </div>
              <div class="col-4 col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/place_3.svg') }}" alt="Badge">
              </div>
              <div class="col-4 col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/taste_4_gold.svg') }}" alt="Badge">
              </div>
              <div class="col-4 col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/here_4_pizza.svg') }}" alt="Badge">
              </div>
            </div>
            <div class="row justify-content-center">
              <a href="#" class="see_all see_all_badges">See all</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
            $experiences = \App\Experience::where("user_id",$user->id)->whereYear("from",$i)->get();
          ?>
          @if($experiences->isNotEmpty() or $sn==1)
            @if($sn == 1)
              <div class="hackathon_section">
                <div class="row">
                  <div class="col-md-12">
                    <h2 class="block-title" style="<?php echo $btn_style ?>">@if($i == "1970"){{date("Y")}}@else{{$i}}@endif</h2>
                  </div>
                  <div class="col-md-12 hackathon_header">
                    <h3>HACKATHONS</h3>
                    <hr />
                  </div>
                  <div class="col-md-12 hackathon_data_section">
                    @foreach($experiences as $experience)
                      <div class="hackathon_data">
                        <div class="container">
                          <div class="row">
                            <div class="col-2 col-md-1 hackathon_thumbnail">
                              <img class="img img-responsive" src="{{ asset('uploads/hackonton/hackathon.svg') }}" alt="hackathon_logo">
                            </div>
                            <div class="col-9 col-md-11">
                              <a href="#" class="hackathon_share_btn only-desktop float-right share_hackathon"><img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">&nbsp;Share</a>
                              <h4>{{ $experience->name }}</h4>
                              <h5>By {{ $experience->organized_by }} <br /> {{ Date('m-d-Y',strtotime($experience->from)) }} - {{ Date('m-d-Y',strtotime($experience->to)) }}</h5>
                              <p class="only-desktop"><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                              <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" class="hackathon_badge_img only-desktop" alt="badge information"><label class="hackathon_badge_title only-desktop">&nbsp;&nbsp;1st Place</label>
                            </div>
                            <div class="col-2 only-mobile">
                              <a href="#" class="hackathon_share_btn only-mobile share_hackathon">
                                <img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">
                              </a>
                            </div>
                            <div class="col-10 only-mobile">
                              <p><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                              <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;1st Place</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
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
                    <h3>HACKATHONS</h3>
                    <hr />
                  </div>
                  <div class="col-md-12 hackathon_data_section">
                    @foreach($experiences as $experience)
                      <div class="hackathon_data">
                        <div class="container">
                          <div class="row">
                            <div class="col-2 col-md-1 hackathon_thumbnail">
                              <img class="img img-responsive" src="{{ asset('uploads/hackonton/hackathon.svg') }}" alt="hackathon_logo">
                            </div>
                            <div class="col-9 col-md-11">
                              <a href="#" class="hackathon_share_btn only-desktop float-right share_hackathon"><img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">&nbsp;Share</a>
                              <h4>{{ $experience->name }}</h4>
                              <h5>By {{ $experience->organized_by }} <br /> {{ Date('m-d-Y',strtotime($experience->from)) }} - {{ Date('m-d-Y',strtotime($experience->to)) }}</h5>
                              <p class="only-desktop"><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                              <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" class="hackathon_badge_img only-desktop" alt="badge information"><label class="hackathon_badge_title only-desktop">&nbsp;&nbsp;1st Place</label>
                            </div>
                            <div class="col-2 only-mobile">
                              <a href="#" class="hackathon_share_btn only-mobile share_hackathon">
                                <img src="{{ asset('new-theme/images/share_icon.svg') }}" alt="share">
                              </a>
                            </div>
                            <div class="col-10 only-mobile">
                              <p><?php echo str_replace("\\","",nl2br($experience->description)) ?></p>
                              <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;1st Place</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
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

  <div class="modal fade" id="all_badges" tabindex="-1" role="dialog" aria-labelledby="all_badgesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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
              <div class="col-md-12 badges_container">
                <div class="container">
                  <div class="row">
                    <?php
                    for($i=0;$i<22;$i++){ ?>
                    <div class="col-md-2 col-4">
                      <div class="single_badge_info">
                        <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" alt="Badge" />
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
          "Pitch Presentation ", 
          "Front End ", 
          "Back End ", 
          "Team player ", 
          "Problem Solving ", 
          "UX Design "
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
          pointLabels:{
            fontColor:"#00FFC2",
            fontFamily:'Monument',
            fontSize:8,
          },
          ticks: {
            fontColor:'#ffffff',
            backdropColor:'transparent',
            stepSize:1,
            min:0,
            max:10,
            fontFamily:'Monument',
            fontSize:12,
            beginAtZero: true
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
  </script>
@endsection
