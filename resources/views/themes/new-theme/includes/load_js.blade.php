<script src="{{asset('theme/hack4pizza/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('theme/hack4pizza/js/loadingoverlay.min.js')}}"></script>
<script src="{{ asset('new-theme/plugins/alertify/alertify.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $(".dropdown").click(function(e){
      e.preventDefault();
      $(".dropdown-content").toggle();
    });
    $(document).on("click", function(event){
        var $trigger = $(".dropdown");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".dropdown-content").hide();
        }            
    });
  })
</script>