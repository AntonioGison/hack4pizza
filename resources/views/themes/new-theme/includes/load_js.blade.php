<script src="{{asset('theme/hack4pizza/js/jquery-3.2.1.slim.min.js')}}"></script>
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