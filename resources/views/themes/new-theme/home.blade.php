@extends('themes.new-theme.app')
@section('additional_css')
  <title>Hack4 Pizza</title>
@endsection
@section('content')
<div class="first_section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12 only-mobile">
        <div class="intro_section align-center">
          <h3><b>HACK. WIN. COLLECT!</b></h3>
          <img alt="Hack4 Pizza" class="img img-responsive" style="width:80%" src="{{asset('new-theme/images/hp_first_left.svg') }}" /> 
        </div>
      </div>
      <div class="col-md-7 only-desktop col-xs-12">
        <img alt="Hack4 Pizza" class="img img-responsive" style="width:80%" src="{{asset('new-theme/images/hp_first_left.svg') }}" /> 
      </div>
      <div class="col-md-5 only-desktop col-xs-12 right_section">
        <h3><b>HACK. WIN. COLLECT!</b></h3>
        <h3>Sign Up</h3>
        <form class="sug_form" method="POST">
          <div class="row">
          <div class="col-md-6">
            <input type="text" name="suf_firstname" placeholder="First Name*" class="form-control suf_input suf_firstname">  
          </div>
          <div class="col-md-6">
            <input type="text" name="suf_lastname" placeholder="Last Name* " class="form-control suf_input suf_lastname">  
          </div>
          <div class="col-md-12">
            <input type="email" name="suf_email" placeholder="Email Address*" class="form-control suf_input suf_email">  
          </div>
          <div class="col-md-12">
            <input type="password" name="suf_password" placeholder="Password*" class="form-control suf_input suf_password">  
          </div>
          <div class="col-md-12">
            <input type="password" name="suf_confirm_password" placeholder="Confirm Password*" class="form-control suf_input suf_confirm_password">  
          </div>
          <div class="col-md-6">
            <input type="text" name="suf_phone" placeholder="Telephone number*" class="form-control suf_input suf_phone">  
          </div>
          <div class="col-md-6">
            <input type="text" name="suf_address" placeholder="City" class="form-control suf_input suf_address">  
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
          <div class="container">
            <div class="social_login_hr_line"><span>OR SIGN UP WITH</span></div>
          </div>
          <div class="login_with_social_media">
            <div class="container">
              <div class="row  justify-content-md-center">
                <div class="col-md-4">
                  <div class="login_with">
                    <a href="{{ route('facebook-login') }}">
                      <img src="{{ asset('new-theme/images/login_with_facebook.svg') }}" alt="Login with Facebook" />
                    </a>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="login_with">
                    <a href="{{ route('linkedin-login') }}">
                      <img src="{{ asset('new-theme/images/login_with_linkedin.svg') }}" alt="Login with LinkedIn" />
                    </a>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="login_with">
                    <a href="{{ route('github-login') }}">
                      <img src="{{ asset('new-theme/images/login_with_github.svg') }}" alt="Login with Github" />
                    </a>
                  </div>
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
<div class="steps_section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
      <h3>HOW IT works</h3>
      <p>Keep track of your Hackathons!<br />it's like Linkedin but with Hackathons<br />it's free and this is a link examples of my Hackathons<br /></p>
      </div>  
      <div class="col-md-6 only-desktop">
        <div class="row">
          <div class="col-md-2">
          <img src="{{ asset('new-theme/images/location_pin.svg') }}" alt="location pin" class="img">
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
      <img src="{{ asset('new-theme/images/step1.svg') }}" alt="step 1" class="img only-desktop">
      <div class="step_box">
        <h4>Step 1</h4>
        <p>Add the attended hackathon in your collection with all the information you want</p>
      </div>
      <img src="{{ asset('new-theme/images/step1.svg') }}" alt="step 1" class="img only-mobile">
      </div>  
      <div class="col-md-4">
      <img src="{{ asset('new-theme/images/step2.svg') }}" alt="step 2" class="img only-desktop">
      <div class="step_box">
        <h4>Step 2</h4>
        <p>Unlock and collect badges!</p>
      </div>  
      <img src="{{ asset('new-theme/images/step2.svg') }}" alt="step 2" class="img only-mobile">
      </div>
      <div class="col-md-4">
      <img src="{{ asset('new-theme/images/step3.svg') }}" alt="step 3" class="img only-desktop">
      <div class="step_box">
        <h4>Step 3</h4>
        <p>Shares your profile with friends, family and potential Big tech willing to hire you!</p>
      </div>
      <img src="{{ asset('new-theme/images/step3.svg') }}" alt="step 3" class="img only-mobile">
      </div>  
    </div>
  </div>
</div>
@endsection
@section('additional_js')
<script src="{{ asset('js/phone_mask.js')}}"></script>
<script>
   $(document).ready(function(){

     $(".suf_phone").usPhoneFormat();

    // For SignUp Form
      function signup_keyup(name){
        $("."+name).keyup(function(){
          $(this).css('background-color','transparent');
        }); 
      }

      function validate_input(name){
        tmp_name = $("."+name).val();
        if(tmp_name==''){
          $("."+name).css('background-color','red');
          return false;
        }
      }
      signup_keyup("suf_firstname");
      signup_keyup("suf_lastname");
      signup_keyup("suf_email");
      signup_keyup("suf_password");
      signup_keyup("suf_confirm_password");
      signup_keyup("suf_phone");
      signup_keyup("suf_address");

      $(".suf_btn").click(function(e){
        e.preventDefault();
        var token = '{{ csrf_token() }}';

        var suf_firstname = $(".suf_firstname").val();
        var suf_lastname = $(".suf_lastname").val();
        var suf_email = $(".suf_email").val();
        var suf_password = $(".suf_password").val();
        var suf_confirm_password = $(".suf_confirm_password").val();
        var suf_phone = $(".suf_phone").val();
        var suf_address = $(".suf_address").val();
        if(validate_input("suf_firstname")==false) { return false;  };
        if(validate_input("suf_lastname")==false){ return false; };
        if(validate_input("suf_email")==false){ return false; };
        if(validate_input("suf_password")==false){ return false; };
        if(validate_input("suf_confirm_password")==false){ return false; };
        if(validate_input("suf_phone")==false){ return false; };

        if ($('#suf_tc').is(":checked")){
          terms = "true";
        }else{
          terms = "false";
        }
        if(terms=="false"){
          alertify.alert("Form Error","Please Check Terms & Conditions");
          return false;
        }
        
      $.ajax({
                type: 'POST',
                url: '{{ route("register") }}',
                data: {
                  _token: token,
                  first_name: suf_firstname, 
                  last_name: suf_lastname, 
                  email: suf_email, 
                  password: suf_password, 
                  confirm_password: suf_confirm_password, 
                  phone_number: suf_phone, 
                  address: suf_address, 
                  terms: terms
                },
                dataType: 'JSON',
                success: function (resp) {
                    $.LoadingOverlay("hide");
                    if (resp.status == 0) {
                        $('<span class="smsg">Congrats..Your Account has been Created!</span>').appendTo(".success-msg").css('color', 'green');
                        var delay = 1000; //Your delay in milliseconds
                        if (resp.slug != null){
                            setTimeout(function () {
                                window.location = '/user/'+resp.slug+'?badgeId=22';
                            }, delay);
                        }else{
                            setTimeout(function () {
                                window.location = '/user/dashboard';
                            }, delay);
                        }
                    } else {
                     
                      error_msg = '';
                      if (typeof resp.firstname != "undefined") {
                        error_msg+= '<div class="login_form_error">'+resp.firstname + '</div>';
                        $(".suf_firstname").css('background-color','red');
                      }
                      if (typeof resp.lastname != "undefined") {
                        error_msg+= '<div class="login_form_error">'+resp.lastname + '</div>';
                        $(".suf_lastname").css('background-color','red');
                      }
                      if (typeof resp.email != "undefined") {
                        error_msg+= '<div class="login_form_error">'+resp.email + '</div>';
                        $(".suf_email").css('background-color','red');
                      }
                      if (typeof resp.phone_number != "undefined") {
                        error_msg+= '<div class="login_form_error">'+resp.phone_number + '</div>';
                        $(".suf_phone").css('background-color','red');
                      }
                      if (typeof resp.password != "undefined") {
                        error_msg+= '<div class="login_form_error">'+resp.password + '</div>';
                        $(".suf_password").css('background-color','red');
                        $(".suf_confirm_password").css('background-color','red');
                      }
                     
                      alertify.alert(
                        "SignUp Error",
                        error_msg
                      )
                    }

                },

            });
      });
   });

</script>
@endsection