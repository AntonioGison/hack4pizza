@extends('layouts.admin')

@section('content')
    <section id="wrapper" class="new-login-register">
        <div class="lg-info-panel">
            <<div class="inner-panel" style="    background: url({{asset("admin/plugins/images/login-admin.jpg")}}) center center/cover no-repeat!important;">

            </div>
        </div>
        <div class="new-login-box">
            <div class="white-box">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h3 class="box-title m-b-0">Sign In to Admin</h3>
                <small>Enter your email below</small>
                <form class="form-horizontal new-lg-form" id="loginform" method="post" action="{{ route('admin.password.email') }}">
                    {{ csrf_field() }}
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label>Email Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Send Password Reset Link</button>
                        </div>
                    </div>

                    {{--<div class="form-group m-b-0">--}}
                    {{--<div class="col-sm-12 text-center">--}}
                    {{--<p>Don't have an account? <a href="register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </form>

            </div>
        </div>
    </section>
{{--<div class="container" style="margin-top: 30px;">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">ADMIN Reset Password</div>--}}
                {{--<div class="panel-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.email') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Send Password Reset Link--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
