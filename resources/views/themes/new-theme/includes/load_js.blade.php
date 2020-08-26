<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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
  })
</script>