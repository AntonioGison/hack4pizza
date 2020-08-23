@extends('themes/new-theme/app')
@section('additional_css')
  <title>Hack4 Pizza</title>
@endsection
@section('content')
<div class="first_section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7 col-xs-12">
        <img alt="Hack4 Pizza" class="img img-responsive" style="width:80%" src="{{asset('new-theme/images/hp_first_left.png') }}" /> 
      </div>
      <div class="col-md-5 col-xs-12 right_section">
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
            <input type="text" name="suf_address" placeholder="Address (Optional)" class="form-control suf_input suf_address">  
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
      <p>Keep track of your Hackathons!<br />it's like Linkedin but with Hackathons<br />it's free and this is a link examples of my Hackathons<br /></p>
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
        if(validate_input("suf_address")==false){ return false; };

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
                                window.location = '/user/'+resp.slug;
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