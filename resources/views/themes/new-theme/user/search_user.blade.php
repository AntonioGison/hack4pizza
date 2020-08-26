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
                <h4>About <span id="result_count">325</span> results</h4>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
            <?php
            for($i=1; $i<10; $i++){
            ?>
            <div class="col-md-2">
              <a href="#" class="search_user_link">
                <div class="search_user_info">
                  <img src="{{ asset('uploads/user-pic/search1.png') }}" alt="user">
                  <h5>John Break</h5>
                  <p>CEO - London, England</p>
                  <hr />
                  <p>4 Hackathon</p>
                </div>
              </a>
            </div>
            <?php 
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection