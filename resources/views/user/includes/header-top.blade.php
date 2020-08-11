<div id="header" class="header_shadow">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 logo">
                <a href="{{route("home")}}">
                    <?php $settings = \App\Setting::pluck('value','name')->toArray(); $logo = isset($settings['logo']) ? $settings['logo']:''; ?>
                    <img alt="Hack4 Pizza" src="{{asset("uploads/$logo")}}" width="45%" />
                </a>
            </div>
            <div class="col-6">
                @if (Auth::check())
                <a class="btn btn-logout d-none d-md-block float-right" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
