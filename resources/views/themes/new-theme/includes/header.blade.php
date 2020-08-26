<div id="header" class="top-bar">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-5 logo">
        <a href="{{ url('/') }}">
          <img alt="Hack4 Pizza" src="{{asset('new-theme/images/logo.svg') }}" />
        </a>
      </div>
      <div class="col-6 offset-1 login_wrapper">
        <form class="login_form">
          <div class="row">
            <div class="col-5 less-padding">
              <input type="text" id="loginEmail" class="form-control login_form_email" placeholder="Enter Email Address"> 
            </div>
            <div class="col-5 less-padding md-inpt">
              <input type="password" id="loginPassword" class="form-control login_form_password" placeholder="Enter Password">
              <a  href="{{ route('password.request') }}" class="login_form_frgt_pw">Forget Password?</a>
            </div>
            <div class="col-2 less-padding">
              <button type="button" id="login_submit" class="btn primary-btn-clr">Login</button>  
            </div>
          </div>
        </form>     
      </div>
    </div>
  </div>
</div>