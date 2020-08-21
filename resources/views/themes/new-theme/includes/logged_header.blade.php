<div id="header" class="top-bar">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-5 logo">
        <a href="#">
          <img alt="Hack4 Pizza" src="{{asset('new-theme/images/logo.png') }}" />
        </a>
      </div>
      <div class="col-6 offset-1 login_wrapper">
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        <div class="row">
          <div class="col-8 less-padding">
            <input type="text" id="searchUser" class="form-control search_user" placeholder="Search"> 
          </div>
         <div class="col-4 logged_menu_right">
           <a href="#"><img src="{{ asset('new-theme/images/notification.png') }}" class="img img-responsive" alt="menu" /></a>
           <a href="#"><img src="{{ asset('uploads/user-pic/headshot.png') }}" style="height:40px;" class="img img-responsive" alt="headshot" /></a>
           <a href="#"><img src="{{ asset('new-theme/images/logged_menu.png') }}" style="height:25px;" class="img img-responsive" alt="menu" /></a>
         </div>
        </div>
    </div>
  </div>
</div>