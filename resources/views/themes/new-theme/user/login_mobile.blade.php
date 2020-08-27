@extends('themes.new-theme.app')
@section('additional_css')
  <title>Hack4 Pizza</title>
@endsection
@section('content')
<div class="first_section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12 only-mobile">
        <div class="intro_section align-left">
          <h3><b>Login!</b></h3>
          <p>Don't have an account?<a href="{{ route('mobile.register') }}">&nbsp;SIGN UP</a></p>
          <form class="login_form" method="POST">
            <div class="row">
           
            <div class="col-md-12">
              <input type="email" name="suf_email" placeholder="Email Address*" class="form-control suf_input suf_email">  
            </div>
            <div class="col-md-12">
              <input type="password" name="suf_password" placeholder="Password*" class="form-control suf_input suf_password">  
            </div>
            <div class="col-md-12">
              <br />
              <button type="button" id="login_submit_mobile" class="btn primary-btn-clr">Login</button>  
            </div>
            <div class="container">
              <div class="social_login_hr_line"><span>OR SIGN IN WITH</span></div>
            </div>
            <div class="login_with_social_media">
              <div class="container">
                <div class="row  justify-content-md-center">
                  <div class="col">
                    <div class="login_with">
                      <a href="{{ route('facebook-login') }}">
                        <img src="{{ asset('new-theme/images/login_with_facebook.svg') }}" alt="Login with Facebook" />
                      </a>
                    </div>
                  </div>
                  <div class="col">
                    <div class="login_with">
                      <a href="{{ route('linkedin-login') }}">
                        <img src="{{ asset('new-theme/images/login_with_linkedin.svg') }}" alt="Login with LinkedIn" />
                      </a>
                    </div>
                  </div>
                  <div class="col">
                    <div class="login_with">
                      <a href="{{ route('github-login') }}">
                        <img src="{{ asset('new-theme/images/login_with_github.svg') }}" alt="Login with Github" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('additional_js')
<script>
   $(document).ready(function(){
    // For Login Form
      $("#loginEmail").keyup(function(){
        $("#loginEmail").css('background-color','#ffffff');
      });
      $("#loginPassword").keyup(function(){
        $("#loginPassword").css('background-color','#ffffff');
      });

      $("#login_submit_mobile").on('click', function () {
        
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
@endsection