@extends('themes.new-theme.app')
@section('additional_css')
  <link href="{{ asset('theme/hack4pizza/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('new-theme/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="dashboard_body">
  <div id="main_info">
    <?php
      $user = Auth::user(); 
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
        <div class="col main_info_wraper dashboard_first_block dashboard_block bt-p-0">
          <div class="row relative">
            <div class="col-md-3 main_info_cover text-center">
              <a href="#">
                <figure class="figure">
                    <img src="<?php echo asset('uploads/user-pic/'.$user_profile_picture); ?>" class="figure-img img-fluid" alt="cover">
                </figure>
              </a>
            </div>
            <div class="col-md-9 basic_info_block">
              <h2>{{ $full_name }} <img src="{{ asset('new-theme/images/verified_user.png') }}" alt="verified" /></h2>
              <p><i class="fa fa-map-marker-alt"></i> &nbsp;{{ $address }}</p>
              <p><i class="fa fa-user"></i> &nbsp;Member Since {{ $member_since }} </p>
            </div>
           
            <div class="col-md-6">
              <div class="bio_info">
                <h2>Biography</h2>
                <p><?php echo $bio ?></p>
              </div>
            </div>
            <div class="col-md-6 no-padding ">
              <div class="rank_info float-right">
                <div class="display_rank">10</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="top_section">
    <div class="container">
      <div class="row ">
        <div class="col-md-8 no-padding">
          <div class="top_hackers">
            <div class="top_hackers_header">
              <h3>TOP 10</h3><hr />
              <div class="row align-items-center">
                <div class="col-md-2 hacker_rank_info">POSITION</div>
                <div class="col-md-2 hacker_rank_info">NAME</div>
                <div class="col-md-2 hacker_rank_info"><img src="{{ asset('new-theme/images/badge1.png') }}" alt="badge"></div>
                <div class="col-md-2 hacker_rank_info"><img src="{{ asset('new-theme/images/badge2.png') }}" alt="badge"></div>
                <div class="col-md-2 hacker_rank_info"><img src="{{ asset('new-theme/images/badge3.png') }}" alt="badge"></div>
                <div class="col-md-2 hacker_rank_info">TOTAL</div>
              </div>
            </div>
            <?php
              for($i=1;$i<11; $i++){
            ?>
            <div class="hacker_rank <?php if($i==10){ echo "hacker_rank_active"; } ?>">
              <div class="row align-items-center">
                <div class="col-md-1 hacker_rank_info">{{ $i }}</div>
                <div class="col-md-3 hacker_rank_info hacker_name">Rick Jones</div>
                <div class="col-md-2 hacker_rank_info hacker_first">10</div>
                <div class="col-md-2 hacker_rank_info hacker_second">8</div>
                <div class="col-md-2 hacker_rank_info hacker_third">12</div>
                <div class="col-md-2 hacker_rank_info">30</div>
              </div>
            </div>
            <?php } ?>
            <div class="top_hacker_see_all">
              <a href="#" class="top_hacker_see_all_btn">See All</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="hacker_prizes">
            <div class="hacker_prize_header">
              <h3>PRIZES</h3><hr />
              <div class="invite_section">
                <label class="invite_input_label">Get your friend to sign up with this unique URL :</label>
                <div  class="invite_input"></div>
                  <div class="invite_share_btns">
                    <a href="#"><i class="fab fa-facebook-f"></i> &nbsp;Share</a>
                    <a href="#"><i class="fab fa-linkedin-in"></i>&nbsp;Share</a>
                    <a href="#"><i class="fa fa-copy"></i> &nbsp;Copy</a>
                  </div>
                </div>
              </div>
              <br /><hr />
              <div class="hacker_rewards">
                <div class="row">
                  <div class="col-md-4 no-padding"><img src="{{ asset('new-theme/images/reward1.svg') }}" alt=""></div>
                  <div class="col-md-8 less-padding hacker_reward_content">
                    <h4>THE TOP 5</h4>
                    <p>every months recive an official Hack4pizza #firstplace t-shirt! </p>
                  </div>
                </div>
              </div>
              <div class="hacker_rewards">
                <div class="row">
                  <div class="col-md-4 no-padding"><img src="{{ asset('new-theme/images/reward2.svg') }}" alt=""></div>
                  <div class="col-md-8 less-padding hacker_reward_content">
                    <h4>THE TOP 10</h4>
                    <p>recive a pack with six pins, two stickers' paper and an official  Hack4pizza t-shirt! </p>
                  </div>
                </div>
              </div>
              <div class="hacker_rewards">
                <div class="row">
                  <div class="col-md-4 no-padding"><img src="{{ asset('new-theme/images/reward3.svg') }}" alt=""></div>
                  <div class="col-md-8 less-padding hacker_reward_content">
                    <h4>THE TOP 20</h4>
                    <p>recive two Hack4pizza stickers' paper! </p>
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