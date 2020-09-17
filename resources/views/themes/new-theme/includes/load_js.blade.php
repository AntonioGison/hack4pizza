<script src="{{asset('theme/hack4pizza/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{asset('theme/hack4pizza/js/loadingoverlay.min.js')}}"></script>
<script src="{{ asset('new-theme/plugins/alertify/alertify.min.js')}}"></script>
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
        $("body").get(0).style.setProperty("--very-dark-bg", "#09062A");
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