@extends('themes.new-theme.app')
@section('additional_css')
  <link href="{{ asset('theme/hack4pizza/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('new-theme/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="dashboard_body">
  <div id="main_info">
    <div class="container">
      <div class="row">
        <div class="col main_info_wraper search_user_block">
          <div class="row">
            <div class="col-md-12">
              <div class="search_result_data">
                <h4>About <span id="result_count">{{$users->count()}}</span> results</h4>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            @foreach($users as $user)
            @php
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
            @endphp
            <div class="col-md-2">
              <a href="{{route('user.profile',$user->slug)}}" class="search_user_link">
                <div class="search_user_info">
                  <img src="{{ $profile_picture }}" alt="user">
                  <h5>{{$user->name}}</h5>
                  <p>CEO - {{$user->address}}</p>
                  <hr />
                  <p>{{$user->experiences_count}} Hackathon</p>
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection