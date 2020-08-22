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