<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("theme/hack4pizza/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("theme/hack4pizza/css/style.css")}}">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" integrity="sha384-wxqG4glGB3nlqX0bi23nmgwCSjWIW13BdLUEYC4VIMehfbcro/ATkyDsF/AbIOVe" crossorigin="anonymous">
    <title>Hack4 Pizza</title>
</head>

<body>

<div id="header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 logo">
                <a href="#">
                    <img alt="Hack4 Pizza" src="{{asset("theme/hack4pizza/images/logo.jpg")}}" />
                </a>
            </div>
            <div class="col-6 login_wrapper">
                @if (Auth::check())
                    <a class="btn btn-logout d-none d-md-block float-right" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a>
                    <a class="btn btn-dashboard d-none d-md-block float-right mr-2" href="{{ route('user.dashboard') }}" >Dashboard</a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                     <button type="button" class="btn btn-login d-none d-md-block float-right" data-toggle="modal" data-target="#login_modal">Login</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="main_content">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-xs-12 main_content_text">
                <h3>Hack.Win.Collect!</h3>
                <p>Keep track of your Hackathons!</p>
                <p>it's like Linkedin but with Hackathons!!</p>
                <p>it's free and this is a <a href="https://hack4.pizza/user/antonio">link examples</a> of my Hackathons!!!</p>
                @if (!Auth::check())
                    <button type="button" class="btn btn-signup d-none d-md-block" data-toggle="modal" data-target="#signup_model">Sign Up</button>
                @endif
                <!--<a href="#" class="btn btn-signup">SIGN UP</a>-->
            </div>
            <div class="col-md-6 col-xs-12">
                <img alt="Hack4 Pizza" src="{{asset("theme/hack4pizza/images/main_img.jpg")}}" />
            </div>
        </div>
		<div class="row align-items-center">
			<div class="col-md-6 col-xs-12"></div>
			<div class="col-md-6 col-xs-12">
				<p class="img-note">*Studies say that pizza is always the solutions of your code bugs</p>
			</div>
			<div class="col-12 d-md-none text-center">
				<button type="button" class="btn btn-signup" data-toggle="modal" data-target="#signup_model">Sign Up</button>
				<p class="btn_signin_helper">Have an Account? <button type="button" class="btn btn_signin_mobile" data-toggle="modal" data-target="#login_modal">Log In</button></p>
			</div>
		</div>
        <div class="row">
            <div class="col-md-6 col-xs-12 col">
                <div class="media madia_note">
                    <div class="media-body align-self-center">
                        <h5 class="mt-0">Are you a Noob?</h5>
                        <p>No problem anyway you'll get a badge after 3 hackathons and no wins</p>
                    </div>
                    <img class="align-self-center" alt="" src="{{asset("theme/hack4pizza/images/badge-3.jpg")}}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="howitwork">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="font-weight-bold">How it Work</h2>
            </div>
        </div>
        <div class="row">
            <?php $works = \App\Work::all();  ?>
            @foreach($works as $work)
                <div class="col-md-4 howitwork_block">
                    <div class="howitwork_block_cover">
                        <img class="align-self-center" alt="" src="{{asset("uploads/works/$work->pic")}}">
                    </div>
                    <div class="howitwork_block_info">
                        <h4>{{$work->title}}</h4>
                        <p>{{$work->description}}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

@include('user.includes.footer')


<div class="modal fade" id="signup_model" tabindex="-1" role="dialog" aria-labelledby="signup_modelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="block_wrapper">
                <h2 class="block-title">Sign Up</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
                <form id="signup_form" class="form_class" enctype="multipart/form-data">
                    <div class="success-msg">

                    </div>
                    @csrf
                    <input type="hidden" id="pic" name="pic">
                    <div class="form-group userBox">
                        <label>Profile name*</label>
                        <input type="text" class="form-control" id="rname">
                    </div>
                    <div class="form-group emailBox">
                        <label>Email*</label>
                        <input type="email" class="form-control" id="remail">
                    </div>
                    <div class="form-group passwordBox" >
                        <label>Password*</label>
                        <input type="password" class="form-control" id="example-progress">
						<span id="password_Progress"><span id="password_strength">bad</span><meter max="4" id="password_bar"></meter></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Upload Hackathon's logo/IMG</label>
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="{{asset("theme/hack4pizza/hackathon_img")}}">
                                <label class="custom-file-label" for="hackathon_img"></label>
                            </div>
                        </div>
                        <div class="form-group col-sm-3 pic_msg">

                        </div>
                    </div>
                    <div class="form-check termsBox" >
                        <input type="checkbox" class="form-check-input" id="terms">
                        <label class="form-check-label" for="terms">Terms & Conditions *</label>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" id="sign-up" class="btn btn-register">Register</button>
                    </div>

					<div class="external_logins">
						<a href="{{route("github-login")}}" id="" class="btn btn-github"><i class="fab fa-github"></i> Login with Github</a>
                        <a href="{{route("linkedin-login")}}" id="" class="btn btn-linkedin"><i class="fab fa-linkedin-in"></i> Login with Linkedin</a>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="login_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" id="loginBox">
        <div class="modal-content">
            <div class="block_wrapper">
                <h2 class="block-title">Sign In</h2>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
                <form id="login_form" class="form_class">
                    <div class="login-success">

                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="loginEmail">
                    </div>
                    <div class="form-group" id="loginmsg">
                        <label>Password</label>
                        <input type="password" class="form-control" id="loginPassword">
                    </div>
                    <div class="form-group row">
						<div class="col-lg-5 btns_helper">
							<button type="button" id="login_submit" class="btn btn-success btn-custom">Login</button>
							<a href="{{ route('password.request') }}" id="" class="btn-simple-forget">forget password?</a>
						</div>
						<div class="col-lg-7 external_btns_helper">
							<a href="{{route("github-login")}}" id="" class="btn btn-github"><i class="fab fa-github"></i> Login with Github</a>
							<a href="{{route("linkedin-login")}}" id="" class="btn btn-linkedin"><i class="fab fa-linkedin-in"></i> Login with Linkedin</a>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{asset("theme/hack4pizza/js/jquery-3.2.1.slim.min.js")}}"></script>
<script src="{{asset("theme/hack4pizza/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("theme/hack4pizza/js/Chart.min.js")}}"></script>
<script src="{{asset("theme/hack4pizza/js/moment.min.js")}}"></script>
<script src="{{asset("theme/hack4pizza/js/bootstrap-datetimepicker.min.js")}}"></script>
<script src="{{asset("theme/hack4pizza/js/loadingoverlay.min.js")}}"></script>
<script src="{{asset("theme/hack4pizza/js/zxcvbn.js")}}"></script>

<script>
    $(function() {

        /** Get Selected File name fileinput **/
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    });
    $('#signup_form').on('change','.custom-file-input', function(event){
        $.LoadingOverlay("show");
        var form = $('form')[0];
        event.preventDefault();
        $.ajax({
            url:"{{ route('ajaxupload.action') }}",
            method:"POST",
            data:new FormData(form),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
                $.LoadingOverlay("hide");
                $(".pic_msg").children().remove();
                $("#pic").val(data.pic);

                if (data.pic == ""){
                    $('<span class="umsg">' + data.massage + '</span>').appendTo(".pic_msg").css('color', 'red');
                }else{
                    var img = {!! json_encode(url('/')) !!}+"/uploads/user-pic/"+data.pic;

                    $(".pic_msg").append('<img src='+img+'/>');
                }
                // $('#message').css('display', 'block');
                // $('#message').html(data.message);
                // $('#message').addClass(data.class_name);
                // $('#uploaded_image').html(data.uploaded_image);
            }
        })
    });
    $(document).ready(function () {

        $("#sign-up").click(function () {
            $.LoadingOverlay("show");
            $("#signup_model").find('.umsg').remove();
            $("#signup_model").find('.emsg').remove();
            $("#signup_model").find('.pmsg').remove();
            $("#signup_model").find('.smsg').remove();
            var token = $("input[name=_token]").val();
            var name = $("#rname").val();
            var email = $("#remail").val();
            var pic = $("#pic").val();
            var password = $("#example-progress").val();
            var terms = "";

            if ($('#terms').is(":checked"))
            {
                terms = "true";
            }
            $.ajax({
                type: 'POST',
                url: '/register',
                data: {_token: token, name: name, email: email, password: password, pic: pic, terms: terms},
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
                        if (typeof resp.name != "undefined") {
                            $('<span class="umsg">' + resp.name + '</span>').appendTo(".userBox").css('color', 'red');
                        }
                        if (typeof resp.email != "undefined") {
                            $('<span class="emsg">' + resp.email + '</span>').appendTo(".emailBox").css('color', 'red');
                        }
                        if (typeof resp.password != "undefined") {
                            $('<span class="pmsg">' + resp.password + '</span>').appendTo(".passwordBox").css('color', 'red');
                        }if (typeof resp.terms != "undefined") {
                            $('<span class="pmsg">Plz Accept the Terms and Conditions</span>').appendTo(".termsBox").css('color', 'red');
                        }


                    }

                },

            });
        });
         $("#login_submit").on('click', function () {
            $.LoadingOverlay("show");
            $("#loginBox").find('.emsg').remove();
            $("#loginBox").find('.pmsg').remove();
            $("#loginBox").find('.smsg').remove();
            $("#loginBox").find('.Emsg').remove();
            var token = $("input[name=_token]").val();
            var email = $("#loginEmail").val();
            var password = $("#loginPassword").val();

            $.ajax({
                type: 'POST',
                url: '/login',
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

                        $('<span class="Emsg">Email/Password Invalid.Try again.</span>').appendTo("#loginmsg").css('color', 'red');

                    }

                },

            });


        });


    });
</script>
<script>

	var strength = {
			0: "bad",
			1: "bad",
			2: "weak",
			3: "good",
			4: "strong"
	}

	var password = document.getElementById('example-progress');
	var meter = document.getElementById('password_bar');
	var text = document.getElementById('password_strength');

	password.addEventListener('input', function()
	{
		var val = password.value;
		var result = zxcvbn(val);

		// Update the password strength meter
		meter.value = result.score;

		// Update the text indicator and password strength meter
		if(val !== "") {
			text.innerHTML = strength[result.score];
			var color = "";
			var bgcolor = "";
			switch (result.score) {
                case 0:
					color = "red";
					bgcolor = "";
                    break;
                case 1:
                    color = "#e11f1b";
					bgcolor = "#e11f1b";
                    break;
                case 2:
                    color = "#f07c0d";
					bgcolor = "#f07c0d";
                    break;
                case 3:
                    color = "#f9db02";
					bgcolor = "#f9db02";
                    break;
                case 4:
                    color = "#78ea37";
					bgcolor = "#78ea37";
                    break;
            }
			text.style.color = color;
			meter.style.background = bgcolor;
		}
		else {
			text.innerHTML = "bad";
			text.style.color = "#e11f1b";
		}
	});

</script>
</body>

</html>
