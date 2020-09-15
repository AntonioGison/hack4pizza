<div class="search_result_number">
    About <span class="number_search">{{$count}}</span> Results
</div>
<div class="row" >
    @foreach($users as $user)
    @php
        $user_profile_picture = $user->profile_picture;
      
        if($user_profile_picture==''){
            $profile_picture = asset('uploads/user-pic/placeholder.jpg');
        }else{
            if($user->facebook_id=='' && 
            $user->linked_id=='' && 
            $user->github_id==''){
                $profile_picture = Storage::url($user_profile_picture);
            }else{
                $profile_picture =  $user_profile_picture;
            }
        }
    @endphp
    <div class="col-md-3">
        <a class="search_profile" href="{{route('user.profile',$user->slug)}}">
            <div class="user_search_box">
                <img src="{{ $profile_picture }}" alt="User" class="img img-responsive">
                <div class="user_name"><h4>{{$user->name}}</h4></div>
            </div>
        </a>
    </div>
    @endforeach
    @if($count>7)
    <div class="col-md-3">
        <div class="user_search_box">
            <a href="{{route('user.search.index')}}?q={{$search_name}}">
                <img src="{{Storage::url('uploads/see_all.png')}}" alt="User" class="img img-responsive">
                <div class="user_name"><h4>See All</h4></div>
            </a>
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="close_btn_sec">
        <a href="#" class="close_btn">Close Search Result</a>
        </div>
    </div>
</div>

<script>
    $(".close_btn").click(function(e){
      e.preventDefault();
      $(".search_area_content").hide();
    });
</script>