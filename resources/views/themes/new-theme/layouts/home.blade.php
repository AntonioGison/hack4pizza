<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('theme/hack4pizza/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/hack4pizza/css/style.css') }}">
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" integrity="sha384-wxqG4glGB3nlqX0bi23nmgwCSjWIW13BdLUEYC4VIMehfbcro/ATkyDsF/AbIOVe" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('new-theme/plugins/alertify/css/alertify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('new-theme/css/custom-style.css') }}">
  <title>Hack4 Pizza</title>  
</head>

<body>

<div id="header" class="top-bar">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-5 logo">
        <a href="#">
          <img alt="Hack4 Pizza" src="{{asset('new-theme/images/logo.png') }}" />
        </a>
      </div>
      <div class="col-6 offset-1 login_wrapper">
        @if (Auth::check())
          <a class="btn btn-logout d-none d-md-block float-right" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
          <a class="btn btn-dashboard d-none d-md-block float-right mr-2" href="{{ route('user.dashboard') }}" >Dashboard</a>
          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        @else
          <form class="login_form">
          <div class="row">
            <div class="col-5 less-padding">
              <input type="text" id="loginEmail" class="form-control login_form_email" placeholder="Enter Email Address"> 
            </div>
            <div class="col-5 less-padding md-inpt">
              <input type="text" id="loginPassword" class="form-control login_form_password" placeholder="Enter Password">
              <a  href="{{ route('password.request') }}" class="login_form_frgt_pw">Forget Password?</a>
            </div>
            <div class="col-2 less-padding">
              <button type="button" id="login_submit" class="btn btn-login primary-btn-clr">Login</button>  
            </div>
          </div>
          </form>     
        @endif
      </div>
    </div>
  </div>
</div>
<div class="first_section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7 col-xs-12">
        <img alt="Hack4 Pizza" class="img img-responsive" style="width:80%" src="{{asset('new-theme/images/hp_first_left.png') }}" /> 
      </div>
      <div class="col-md-5 col-xs-12 right_section">
        <h3><b>HACK. WIN. COLLECT!</b></h3>
        <h3>Sign Up</h3>
        <form class="sug_form" enctype="multipart/form-data">
          <div class="row">
          <div class="col-md-6">
            <input type="text" name="name" placeholder="Name*" class="form-control suf_input suf_name">  
          </div>
          <div class="col-md-6">
            <input type="text" name="company" placeholder="Company Name* " class="form-control suf_input suf_company_name">  
          </div>
          <div class="col-md-12">
            <input type="text" name="email" placeholder="Email Address*" class="form-control suf_input suf_email">  
          </div>
          <div class="col-md-12">
            <input type="text" name="email" placeholder="Password*" class="form-control suf_input suf_email">  
          </div>
          <div class="col-md-12">
            <input type="text" name="email" placeholder="Confirm Password*" class="form-control suf_input suf_email">  
          </div>
          <div class="col-md-6">
            <input type="text" name="name" placeholder="Telephone number*" class="form-control suf_input suf_name">  
          </div>
          <div class="col-md-6">
            <input type="text" name="company" placeholder="Phone Optional" class="form-control suf_input suf_company_name">  
          </div>
          <div class="col-md-12">
            <div class="checkbox_input">
            <input type="checkbox" id="suf_tc" name="terms" class="suf_terms">
            <label for="suf_tc">&nbsp;&nbsp;I agree the T&C and Privacy</label>
            </div>
          </div>
          <div class="col-md-12">
            <button type="btn" class="suf_btn btn form-control">SIGN UP</button>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="steps_section">
  <div class="container">
  <div class="row">
    <div class="col-md-6">
    <h3>HOW IT works</h3>
    <p>Keep track of your Hackathons!<br />
it's like Linkedin but with Hackathons<br />
it's free and this is a link examples of my Hackathons<br /></p>
    </div>  
    <div class="col-md-6">
    <div class="row">
      <div class="col-md-2">
      <img src="{{ asset('new-theme/images/location_pin.png') }}" alt="location pin" class="img">
      </div>
      <div class="col-md-8">
      <h5>Are you a Noob?</h5>
      <p>No problem anyway you'll get a badge after 3 hackathons  and no wins</p>
      </div>
    </div>
    </div>  
  </div><br />
  <div class="row">
    <div class="col-md-4">
    <img src="{{ asset('new-theme/images/step1.png') }}" alt="step 1" class="img">
    <div class="step_box">
      <h4>Step 1</h4>
      <p>Add the attended hackathon in your collection with all the information you want</p>
    </div>
    </div>  
    <div class="col-md-4">
    <img src="{{ asset('new-theme/images/step2.png') }}" alt="step 2" class="img">
    <div class="step_box">
      <h4>Step 2</h4>
      <p>Unlock and collect badges!</p>
    </div>  
    </div>
    <div class="col-md-4">
    <img src="{{ asset('new-theme/images/step3.png') }}" alt="step 3" class="img">
    <div class="step_box">
      <h4>Step 3</h4>
      <p>Shares your profile with friends, family and potential Big tech willing to hire you!</p>
    </div>
    </div>  
  </div>
  </div>
</div>

@include('themes.new-theme.includes.footer')

<script src="{{asset('theme/hack4pizza/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('theme/hack4pizza/js/loadingoverlay.min.js')}}"></script>
<script src="{{ asset('new-theme/plugins/alertify/alertify.min.js')}}"></script>

<script>
   $(document).ready(function(){
    
    $("#loginEmail").keyup(function(){
      $("#loginEmail").css('background-color','#ffffff');
    });
    $("#loginPassword").keyup(function(){
      $("#loginPassword").css('background-color','#ffffff');
    });

    $("#login_submit").on('click', function () {
      
      var token = '{{ csrf_token() }}';
      var email = $("#loginEmail").val();
      var password = $("#loginPassword").val();

      if(email==''){
        $("#loginEmail").css('background-color','#ff7272');
        return false;
      }
      if(password==''){
        $("#loginPassword").css('background-color','#ff7272');
        return false;
      }

      $.LoadingOverlay("show");

      $.ajax({
        type: 'POST',
        url: '{{ route("login") }}',
        data: {_token: token, name: name, email: email, password: password},
        dataType: 'JSON',
        success: function (resp) {
          $.LoadingOverlay("hide");
          if (resp.status == 0) {
            $('<span class="smsg">You have successfully logedin</span>').appendTo(".login-success").css('color', 'green');
            var delay = 1000; //Your delay in milliseconds
            if (resp.slug != null){
              setTimeout(function () {
                window.location = '/user/'+resp.slug;
              }, delay);
            }else{
              setTimeout(function () {
                window.location = '/user/dashboard';
              }, delay);
            }

          } else {
            alertify.alert(
              "Login Failed",
              "<span class='login_form_error'>Email/Password Invalid.Try again.</span>");
          }

        },

      });
    });
   });

</script>
</body>

</html>
