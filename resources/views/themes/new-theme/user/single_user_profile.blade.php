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
      $member_since =(date("Y",strtotime($user->created_at)));

      if($address==''){
        $address = "Address not available.";
      }
      if($user_profile_picture==''){
        $user_profile_picture = "placeholder.jpg";
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
            <div class="col-md-3 main_info_cover text-center">
              <a href="#">
                <figure class="figure">
                    <img src="<?php echo asset('uploads/user-pic/'.$user_profile_picture); ?>" class="figure-img img-fluid" alt="cover">
                </figure>
              </a>
            </div>
            <div class="col-md-5 basic_info_block">
              <h2>{{ $full_name }} <img src="{{ asset('new-theme/images/verified_user.png') }}" alt="verified" /></h2>
              <p><i class="fa fa-map-marker-alt"></i> &nbsp;{{ $address }}</p>
              <p><i class="fa fa-user"></i> &nbsp;Member Since {{ $member_since }} </p>
            </div>
            <div class="col-md-4 main_info_links">
              <div class="share_block">
                <a href="#"><i class="fab fa-facebook-f"></i> &nbsp;Share</a>
                <a href="#"><i class="fab fa-linkedin-in"></i>&nbsp;Share</a>
                <a href="#"><i class="fa fa-copy"></i> &nbsp;Copy</a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="bio_info">
                <h2>Biography</h2>
                <p><?php echo $bio ?></p>
              </div>
            </div>
            <div class="col-md-6">
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
              <div class="col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" alt="Badge">
              </div>
              <div class="col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/place_3.svg') }}" alt="Badge">
              </div>
              <div class="col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/taste_4_gold.svg') }}" alt="Badge">
              </div>
              <div class="col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/here_4_pizza.svg') }}" alt="Badge">
              </div>
              <div class="col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" alt="Badge">
              </div>
              <div class="col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/place_3.svg') }}" alt="Badge">
              </div>
              <div class="col-md-3 display_badge_block">
                <img src="{{ asset('uploads/badges/new_badges/taste_4_gold.svg') }}" alt="Badge">
              </div>
              <div class="col-md-3 display_badge_block">
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
          <div class="hackathon_section">
            <div class="row">
              <div class="col-md-12">
                <h2 class="block-title">2020</h2>
              </div>
              <div class="col-md-12 hackathon_header">
                <h3>HACKATHONS</h3>
                <hr />
              </div>
              <div class="col-md-12 hackathon_data_section">
                <div class="hackathon_data">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-1">
                        <img class="img img-responsive" src="{{ asset('uploads/hackonton/hackathon.svg') }}" alt="hackathon_logo">
                      </div>
                      <div class="col-md-11">
                        <a href="#" class="hackathon_share_btn float-right share_hackathon"><i class="fa fa-share-square"></i>&nbsp;Share</a>
                        <h4>Startup weekend COVID-19 Italy</h4>
                        <h5>By Techstars <br /> 17/04/2020 - 19/04/2020</h5>
                        <p>I’ve been a Mentor at this event. I just loved the experience. Due the coronavirus the event was online Startup Weekend.</p>
                        <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;1st Place</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="hackathon_data">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-1">
                        <img class="img img-responsive" src="{{ asset('uploads/hackonton/hackathon.svg') }}" alt="hackathon_logo">
                      </div>
                      <div class="col-md-11">
                        <a href="#" class="hackathon_share_btn float-right share_hackathon"><i class="fa fa-share-square"></i>&nbsp;Share</a>
                        <h4>Startup weekend COVID-19 Italy</h4>
                        <h5>By Techstars <br /> 17/04/2020 - 19/04/2020</h5>
                        <p>I’ve been a Mentor at this event. I just loved the experience. Due the coronavirus the event was online Startup Weekend.</p>
                        <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;1st Place</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hackathon_section">
            <div class="row">
              <div class="col-md-12">
                <h2 class="block-title">2019</h2>
              </div>
              <div class="col-md-12 hackathon_header">
                <h3>HACKATHONS</h3>
                <hr />
              </div>
              <div class="col-md-12 hackathon_data_section">
                <div class="hackathon_data">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-1">
                        <img class="img img-responsive" src="{{ asset('uploads/hackonton/hackathon.svg') }}" alt="hackathon_logo">
                      </div>
                      <div class="col-md-11">
                        <a href="#" class="hackathon_share_btn float-right share_hackathon"><i class="fa fa-share-square"></i>&nbsp;Share</a>
                        <h4>Startup weekend COVID-19 Italy</h4>
                        <h5>By Techstars <br /> 17/04/2020 - 19/04/2020</h5>
                        <p>I’ve been a Mentor at this event. I just loved the experience. Due the coronavirus the event was online Startup Weekend.</p>
                        <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;1st Place</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="hackathon_data">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-1">
                        <img class="img img-responsive" src="{{ asset('uploads/hackonton/hackathon.svg') }}" alt="hackathon_logo">
                      </div>
                      <div class="col-md-11">
                        <a href="#" class="hackathon_share_btn float-right share_hackathon"><i class="fa fa-share-square"></i>&nbsp;Share</a>
                        <h4>Startup weekend COVID-19 Italy</h4>
                        <h5>By Techstars <br /> 17/04/2020 - 19/04/2020</h5>
                        <p>I’ve been a Mentor at this event. I just loved the experience. Due the coronavirus the event was online Startup Weekend.</p>
                        <img src="{{ asset('uploads/badges/new_badges/place_1.svg') }}" class="hackathon_badge_img" alt="badge information"><label class="hackathon_badge_title">&nbsp;&nbsp;1st Place</label>
                      </div>
                    </div>
                  </div>
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
@section('models')
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
                <div class="copy_section col-md-9">
                  <div class="row">
                    <div class="col-md-9">
                      <span>
                        <?php echo url('/')."user/".$slug; ?>
                      </span>
                    </div>
                    <div class="col-md-3">
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
  <div class="modal fade" id="hackathon_edit" tabindex="-1" role="dialog" aria-labelledby="hackathon_editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="block_wrapper">
          <h2 class="block-title">Edit Hackathon</h2>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
          <form id="hackathon_edit_form" class="form_class" method="post" enctype="multipart/form-data">
            <div class="form-group">
              @csrf
              <input type="hidden" id="he_pic">
              <input type="hidden" id="he_id">
              <label>Hackathon's name*</label>
              <input type="text" class="form-control" id="he_name" >
            </div>
            <div class="form-group">
              <label>Hosted/Organized by*</label>
              <input type="text" class="form-control" id="he_organized" >
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>From*</label>
                <input type="text" class="form-control datepicker" id="he_from" >
              </div>
              <div class="form-group col-md-4">
                <label>To*</label>
                <input type="text" class="form-control datepicker" id="he_to" >
              </div>
              <div class="form-group col-md-4" >
                <label>Result*</label>
                <select class="form-control" id="he_result">
                  @foreach($badges as $badge)
                    <option value="{{$badge->id}}">{{$badge->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>Description (HTML editor)*</label>
              <textarea class="form-control"
                    rows="5" id="he_description"></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Upload Hackathon's logo/IMG</label>
                <div class="custom-file">
                  <input type="file" name="file" class="custom-file-input" id="hackathon_img">
                  <label class="custom-file-label" for="hackathon_img"></label>
                </div>
              </div>
              <div class="form-group col-sm-2 he_pic_msg">

              </div>
              <div class="form-group col-sm-2 he_success">

              </div>
            </div>
            <div class="form-group text-right">
              {{--<a href="#" class="btn-delete"><img alt="" src="{{asset("theme/hack4pizza/images/icon_delete.jpg")}}" /></a>--}}
              <button type="button" id="he_submit" class="btn btn-success">Save</button>
            </div>
          </form>
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
                    <div class="col-md-2">
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
  <script src="{{ asset('theme/hack4pizza/js/jquery-3.2.1.slim.min.js')}}"></script>
  <script src="{{ asset('theme/hack4pizza/js/bootstrap.bundle.min.js')}}"></script>
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
          data: [{{$user->performance->pitch or '0'}},
            {{$user->performance->front_end or '0'}},
            {{$user->performance->back_end or '0'}},
            {{$user->performance->team_player or '0'}},
            {{$user->performance->problem_solving or '0'}},
            {{$user->performance->ux_design or '0'}}],
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
      })

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
  <script type="text/javascript">
    $("#profile_submit").click(function () {
      $.LoadingOverlay("show");
      $("#signup_model").find('.umsg').remove();
      $("#signup_model").find('.emsg').remove();
      $("#signup_model").find('.pmsg').remove();
      $("#signup_model").find('.smsg').remove();
      var token = $("input[name=_token]").val();
      var name = $("#name").val();
      var email = $("#email").val();
      var pic = $("#pic").val();
      var password = $("#password").val();
      var name1 = $("#name1").val();
      var name2 = $("#name2").val();
      var name3 = $("#name3").val();
      var url1 = $("#url1").val();
      var url2 = $("#url2").val();
      var url3 = $("#url3").val();
      var id = $("#id").val();
      var bio = $("#bio").val();
      $.ajax({
        type: 'POST',
        url: "{{route("user-update")}}",
        data: {_token: token, name: name, email: email, password: password, bio: bio, name1: name1,name2: name2,name3: name3,url1: url1,url2: url2,url3: url3, id: id, pic: pic},
        dataType: 'JSON',
        success: function (resp) {
          $.LoadingOverlay("hide");
          if (resp.status == 0) {
            $('<span class="smsg">Congrats..Your Profile has been Updated!</span>').appendTo(".success-msg").css('color', 'green');
            var delay = 1000; //Your delay in milliseconds
            setTimeout(function () {
              window.location = '/user/dashboard';
            }, delay);
          } else {
            if (typeof resp.name != "undefined") {
              $('<span class="umsg">' + resp.name + '</span>').appendTo(".userBox").css('color', 'red');
            }
            if (typeof resp.email != "undefined") {
              $('<span class="emsg">' + resp.email + '</span>').appendTo(".emailBox").css('color', 'red');
            }
            if (typeof resp.password != "undefined") {
              $('<span class="pmsg">' + resp.password + '</span>').appendTo(".passwordBox").css('color', 'red');
            }


          }

        },

      });
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
    $("#he_submit").click(function () {
      $.LoadingOverlay("show");
      $("#hackathon_edit").find('.emsg').remove();
      var token = $("input[name=_token]").val();
      var name = $("#he_name").val();
      var organized_by = $("#he_organized").val();
      var from = $("#he_from").val();
      var to = $("#he_to").val();
      var result = $("#he_result").val();
      var description = $("#he_description").val();
      var pic = $("#he_pic").val();
      var id = $("#he_id").val();
      $.ajax({
        type: 'POST',
        url: "{{route("update-hackonton")}}",
        data: {_token: token, name: name, organized_by: organized_by, from: from, to: to, result: result, description: description, pic: pic, id: id},
        dataType: 'JSON',
        success: function (resp) {
          $.LoadingOverlay("hide");
          if (resp.status == 0) {
            $('<span class="emsg">Congrats..Your Hackonton has been Updated!</span>').appendTo(".he_success").css('color', 'green');
            var delay = 1000; //Your delay in milliseconds
            setTimeout(function () {
              window.location = '/user/dashboard';
            }, delay);
          } else {
            if (typeof resp.name != "undefined") {
              $("#he_name").parent().append('<span class="emsg">' + resp.name + '</span>').css('color', 'red');
            }
            if (typeof resp.description != "undefined") {
              $("#he_description").parent().append('<span class="emsg">' + resp.description + '</span>').css('color', 'red');
            }
            if (typeof resp.result != "undefined") {
              $("#he_result").parent().append('<span class="emsg">' + resp.result + '</span>').css('color', 'red');
            }
            if (typeof resp.from != "undefined") {
              $("#he_from").parent().append('<span class="emsg">' + resp.from + '</span>').css('color', 'red');
            }
            if (typeof resp.to != "undefined") {
              $("#he_to").parent().append('<span class="emsg">' + resp.to + '</span>').css('color', 'red');
            }
            if (typeof resp.organized_by != "undefined") {
              $("#he_organized").parent().append('<span class="emsg">' + resp.organized_by + '</span>').css('color', 'red');
            }


          }

        },

      });
    });
    $("#per_submit").click(function () {
      $.LoadingOverlay("show");
      $("#performance_model").find('.emsg').remove();
      var token = $("input[name=_token]").val();
      var pitch = $("#pitch").val();
      var front_end = $("#front_end").val();
      var back_end = $("#back_end").val();
      var team_player = $("#team_player").val();
      var ux_design = $("#ux_design").val();
      var problem_solving = $("#problem_solving").val();
      var id = $("#per_id").val();
      $.ajax({
        type: 'POST',
        url: "{{route("update-performance")}}",
        data: {_token: token, pitch: pitch, front_end: front_end, back_end: back_end, team_player: team_player, ux_design: ux_design, problem_solving: problem_solving,id: id,},
        dataType: 'JSON',
        success: function (resp) {
          $.LoadingOverlay("hide");
          if (resp.status == 0) {
            $('<span class="emsg">Congrats..Your Hackonton has been Updated!</span>').appendTo(".per_success").css('color', 'green');
            var delay = 1000; //Your delay in milliseconds
            setTimeout(function () {
              window.location = '/user/dashboard';
            }, delay);
          } else {
            if (typeof resp.pitch != "undefined") {
              $("#pitch").parent().append('<span class="emsg">' + resp.pitch + '</span>').css('color', 'red');
            }
            if (typeof resp.front_end != "undefined") {
              $("#front_end").parent().append('<span class="emsg">' + resp.front_end + '</span>').css('color', 'red');
            }
            if (typeof resp.back_end != "undefined") {
              $("#back_end").parent().append('<span class="emsg">' + resp.back_end + '</span>').css('color', 'red');
            }
            if (typeof resp.team_player != "undefined") {
              $("#team_player").parent().append('<span class="emsg">' + resp.team_player + '</span>').css('color', 'red');
            }
            if (typeof resp.ux_design != "undefined") {
              $("#ux_design").parent().append('<span class="emsg">' + resp.ux_design + '</span>').css('color', 'red');
            }
            if (typeof resp.problem_solving != "undefined") {
              $("#problem_solving").parent().append('<span class="emsg">' + resp.problem_solving + '</span>').css('color', 'red');
            }


          }

        },

      });
    });
    $('#profile_form').on('change','.custom-file-input', function(event){
      $.LoadingOverlay("show");
      var form = $('form#profile_form')[0];
      event.preventDefault();
      $.ajax({
        url:"{{ route('ajaxupload.action') }}",
        method:"POST",
        data:new FormData(form),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
          $.LoadingOverlay("hide");
          $(".pic_msg").children().remove();
          $("#pic").val(data.pic);

          if (data.pic == ""){
            $('<span class="umsg">' + data.massage + '</span>').appendTo(".pic_msg").css('color', 'red');
          }else{
            $(".pic_msg").append(data.uploaded_image);
          }
          // $('#message').css('display', 'block');
          // $('#message').html(data.message);
          // $('#message').addClass(data.class_name);
          // $('#uploaded_image').html(data.uploaded_image);
        }
      })
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
    $('#hackathon_edit_form').on('change','.custom-file-input', function(event){
      $.LoadingOverlay("show");
      var form = $('form#hackathon_edit_form')[0];
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
          $(".he_pic_msg").children().remove();
          $("#he_pic").val(data.pic);

          if (data.pic == ""){
            $('<span class="umsg">' + data.massage + '</span>').appendTo(".he_pic_msg").css('color', 'red');
          }else{
            $(".he_pic_msg").append(data.uploaded_image);
          }
          // $('#message').css('display', 'block');
          // $('#message').html(data.message);
          // $('#message').addClass(data.class_name);
          // $('#uploaded_image').html(data.uploaded_image);
        }
      })
    });
    $(".btn-edit").click(function () {
       var pic = $(this).attr("pic");
       var description = $(this).attr("description");
       var from = $(this).attr("from");
       var to = $(this).attr("to");
       var organized_by = $(this).attr("organized_by");
       var badge = $(this).attr("badge");
       var name = $(this).attr("h_name");
       var id = $(this).attr("he_id");
       var src_pic = $(this).attr("src_pic");
       src_pic = "<img width='100%' src="+src_pic+">";
       $("#he_pic").val(pic);
       $("#he_description").val(description);
       $("#he_from").val(from);
       $("#he_to").val(to);
       $("#he_organized").val(organized_by);
       $("#he_badge").val(badge);
       $("#he_name").val(name);
       $("#he_id").val(id);
       $(".he_pic_msg").html(src_pic);

    });
  </script>

@endsection
