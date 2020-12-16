<script src="{{asset('theme/hack4pizza/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{asset('theme/hack4pizza/js/loadingoverlay.min.js')}}"></script>
<script src="{{ asset('new-theme/plugins/alertify/alertify.min.js')}}"></script>
<script src="{{ asset('theme/hack4pizza/js/Chart.min.js')}}"></script>
<script src="{{ asset('theme/hack4pizza/js/moment.min.js')}}"></script>
<script src="{{ asset('theme/hack4pizza/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('new-theme/plugins/sweetalert/js/sweetalert.min.js')}}"></script>

<script>
  $(document).ready(function(){
    $("#searchUser").focus(function(e){
      e.preventDefault();
      $(".search_area_content").show();
    });
    $(".close_btn").click(function(e){
      e.preventDefault();
      $(".search_area_content").hide();
    });
    $(".dark_mode_input").change(function(){
      if($(this).prop("checked") == true){
        // do everything to make it dark
        $("body").get(0).style.setProperty("--very-dark-bg", "#09062A");
        $("body").get(0).style.setProperty("--light-color", "#ffffff");
        $("body").get(0).style.setProperty("--dark-bg", "#25215A");
        $("body").get(0).style.setProperty("--dark-blue", "#3B3677");
      } else if($(this).prop("checked") == false){
        // do everything to make it light
        $("body").get(0).style.setProperty("--very-dark-bg", "#3B3677");
        $("body").get(0).style.setProperty("--light-color", "#333333");
        $("body").get(0).style.setProperty("--dark-bg", "#f3f3f3");
        $("body").get(0).style.setProperty("--dark-blue", "#ffffff");
      }
    });

    $(".dropdown-content").click(function(e){
      e.stopPropagation();
    });

    //select theme modal
    var isLoggedin = "{{$isLoggedin}}";
    
    if(isLoggedin!=0) {
      var userTheme  = "{{$loggedUserTheme}}";
      if(userTheme != 'dark' && userTheme != 'light') {
        $('#select_theme').modal('show');
      }
    }
  });

  function store_recent_search(url) {
    var token = $("input[name=_token]").val();
    var q = $('#searchUser').val();
    $.ajax({
      type: 'POST',
      url: "{{route("user.store_recent_search")}}",
      data: {_token: token, q: q},
      dataType: 'JSON',
      success: function (resp) {
        window.location.href = url;
      },
    });
  }

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
  });
</script>

<script>

  // Display edit profile Modal
  $(".edit-profile-icon").click(function(e){
    e.preventDefault();
    $("#profile_modal").modal();
  });

  // Display Add Hackathon Modal
  $(".add_hackathon").click(function(e){
    e.preventDefault();
    $("#hackathon_add").modal();
    $(".new_hackathon_img").change(function(){
        previewFile('new_hackathon_img');
    });
  });

  $("#profile_submit").click(function (e) {
    $("#signup_model").find('.umsg').remove();
    $("#signup_model").find('.emsg').remove();
    $("#signup_model").find('.pmsg').remove();
    $("#signup_model").find('.smsg').remove();
    // var token = $("input[name=_token]").val();
    // var name = $("#name").val();
    // var pic = $("#pic").val();    
    // var bio = $("#bio").val();
    var form2 = $('form#update_user_profile_form')[0];
    e.preventDefault();
    
    $.ajax({
      type: 'POST',
      url: "{{route('user-update')}}",
      method:"POST",
      data:new FormData(form2),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success:function(resp)
      {
        $.LoadingOverlay("hide");
        if (resp.status == 0) {
          $('<span class="smsg">Congrats..Your Profile has been Updated!</span>').appendTo(".success-msg").css('color', 'green');
          var delay = 1000; //Your delay in milliseconds
          setTimeout(function () {
            userProfileRoute = "{{route('user.profile',$loggedUserSlug)}}";
            window.location.href = userProfileRoute;
            // location.reload(true);
          }, delay);
        } else {
          if (typeof resp.name != "undefined") {
            $('<span class="umsg">' + resp.name + '</span>').appendTo(".userBox").css('color', 'red');
          }
          if (typeof resp.email != "undefined") {
            $('<span class="emsg">' + resp.email + '</span>').appendTo(".emailBox").css('color', 'red');
          }
          if (typeof resp.password != "undefined") {
            $('<span class="pmsg">' + resp.password + '</span>').appendTo(".passwordBox").css('color', 'red');
          }

        }
        
      }
    });
  });

  $("#ha_submit").click(function () {
    $("#hackathon_add").find('.emsg').remove();
    var token = $("input[name=_token]").val();
    var name = $("#ha_name").val();
    var organized_by = $("#ha_organized").val();
    var from = $("#ha_from").val();
    var to = $("#ha_to").val();
    var result = $("#ha_result").val();
    var description = $("#ha_description").val();
    var pic = $("#ha_pic").val();
    var form3 = $('form#hackathon_add_form')[0];
    $.ajax({
      type: 'POST',
      url: "{{route('add-hackonton')}}",
      data: new FormData(form3),
      cache : false,
      processData: false,
      contentType: false,
      success: function (resp) {
        $.LoadingOverlay("hide");
        if (resp.status == 0) {
          $('<span class="emsg">Congrats..Your Hackonton has been Added!</span>').appendTo(".ha_success").css('color', 'green');
          var delay = 1000; //Your delay in milliseconds
          setTimeout(function () {
            userProfileRoute = "{{route('user.profile',$loggedUserSlug)}}";
            // window.location.href = window.location.href.replace( /[\?#].*|$/, "?badgeId="+resp.badge_id );
            window.location.href = userProfileRoute+"?badgeId="+resp.badge_id;
            // location.reload(true);
          }, delay);
        } else {
          if (typeof resp.name != "undefined") {
            $("#ha_name").parent().append('<span class="emsg">' + resp.name + '</span>').css('color', 'red');
          }
          if (typeof resp.description != "undefined") {
            $("#ha_description").parent().append('<span class="emsg">' + resp.description + '</span>').css('color', 'red');
          }
          if (typeof resp.result != "undefined") {
            $("#ha_result").parent().append('<span class="emsg">' + resp.result + '</span>').css('color', 'red');
          }
          if (typeof resp.from != "undefined") {
            $("#ha_from").parent().append('<span class="emsg">' + resp.from + '</span>').css('color', 'red');
          }
          if (typeof resp.to != "undefined") {
            $("#ha_to").parent().append('<span class="emsg">' + resp.to + '</span>').css('color', 'red');
          }
          if (typeof resp.organized_by != "undefined") {
            $("#ha_organized").parent().append('<span class="emsg">' + resp.organized_by + '</span>').css('color', 'red');
          }


        }

      },

    });
  });

  /** datetimepicker **/
  $('.datepicker_from').datetimepicker({
    format: 'DD-MM-YYYY',
    widgetPositioning: {
      horizontal: "auto",
      vertical: "bottom"
    }
  });
  $('.datepicker_to').datetimepicker({
    format: 'DD-MM-YYYY',
    widgetPositioning: {
      horizontal: "auto",
      vertical: "bottom"
    }
  });

  function previewFile(inputclass) {
    var preview = document.querySelector(".display_"+inputclass+" img");
    var file    = document.querySelector('.'+inputclass).files[0];
    /*var files   = document.querySelector('.'+inputclass).files;*/
    var reader  = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
  }

  function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
  }
</script>

@if(Auth::check())
<script>
  var searchElement = document.getElementById("searchUser");
  searchElement.addEventListener("keyup", function(event) {
    var token = $("input[name=_token]").val();
    var name = searchElement.value;
    
    //send to detail search page on hitting enter key
    if (event.keyCode === 13) {
      store_recent_search('{{route('user.search.index')}}?q='+name);
    } else {
      $.ajax({
        type: 'POST',
        url: "{{route("user.search_users_ajax")}}",
        data: {_token: token, name: name},
        dataType: 'JSON',
        success: function (resp) {
          if(resp.html) {
            $('.search_area_html').html(resp.html)
          }
        },
      });
    }
  });
</script>
@endif