@extends('user.layouts.master')
@section('stylesheets')
    <link href="{{ asset('admin/assets/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/datatable/dataTables.responsive.min.js') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <style type="text/css">
        .btn-circle.btn-lg{
            width: 30px;
            height: 30px;
            padding: 5px 5px;
            border-radius: 30px;
            font-size: 14px;
            line-height: 1.33;
        }
    </style>
    <![endif]-->
@endsection
@section('content')
    <div id="main_info">
        <?php $user = Auth::user(); $badges = \App\Badge::all();$m_badges = \App\MasterBadge::all();?>
        <?php
        $max = (date("Y",strtotime($user->experiences->max("from"))));
        $min =(date("Y",strtotime($user->experiences->min("from"))));
        ?>
        <div class="container">
            @if(Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }}
                </div>
            @endif
            <div class="row">
                <div class="col main_info_wraper block_wrapper">
                    <div class="row relative">
                        <div class="col-md-3 main_info_cover text-center">
                            <a href="#">
                                <figure class="figure">
                                    @if($user->pic)
                                        <img src="{{asset("uploads/user-pic/$user->pic")}}" class="figure-img img-fluid" alt="cover">
                                    @else
                                        <img src="{{asset("uploads/placeholder.jpg")}}" class="figure-img img-fluid" alt="cover">
                                    @endif
                                </figure>
                            </a>
                        </div>
                        <div class="col-md-7 main_info_info">
                            <h2>{{$user->name}}</h2>
                            <p>{{$user->bio or ''}}</p>
                        </div>
                        <div class="col-md-2 main_info_links">
                            <ul>
                                <li>
                                    <div class="media">
                                        <img class="mr-3 align-self-center" src="{{asset("theme/hack4pizza/images/link_globe.jpg")}}" alt="">
                                        <div class="media-body">
                                            <a href="{{$user->url1 or '#'}}">{{$user->name1 or 'Social Link'}}</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img class="mr-3 align-self-center" src="{{asset("theme/hack4pizza/images/link_globe.jpg")}}" alt="">
                                        <div class="media-body">
                                            <a href="{{$user->url2 or '#'}}">{{$user->name2 or 'Social Link'}}</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img class="mr-3 align-self-center" src="{{asset("theme/hack4pizza/images/link_globe.jpg")}}" alt="">
                                        <div class="media-body">
                                            <a href="{{$user->url3 or '#'}}">{{$user->name3 or 'Social Link'}}</a>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                            <button type="button" class="btn-edit" data-toggle="modal" data-target="#profile_model"><img alt="" src="{{asset("theme/hack4pizza/images/icon_edit.jpg")}}" /></button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="performance-badges">
        <div class="container">
            <div class="row">
                <div class="col-md-6 performance">
                    <div class="block_wrapper">
                        <h2 class="block-title">Performance</h2>
                        <button type="button" class="btn-edit" data-toggle="modal" data-target="#performance_model"><img alt="" src="{{asset("theme/hack4pizza/images/icon_edit.jpg")}}" /></button>
                        <div class="row align-items-center justify-content-center badge-min-height">
                            <div class="col-12 text-center">
                                <div id="chartjs-radar">
                                    <canvas id="canvas"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 badges">
                    <div class="block_wrapper">
                        <h2 class="block-title">Badges</h2>
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <div class="row align-items-center justify-content-center badge-min-height">
                                    <?php $bage_no = 0;?>
                                    @foreach($badges as $badge)
                                        <?php $count = \App\Experience::where([['user_id','=',$user->id],['badge_id','=',$badge->id]])->count(); ?>
                                        @if($count > 0)
                                            <?php $bage_no++;?>
                                            <div class="col-4 badge-container text-center">
                                                <div class="badge-wrapper">
                                                    <img class="" src="{{asset("uploads/badges/$badge->pic")}}" alt="">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @foreach($m_badges as $m_badge)
                                        <?php $count = \App\Experience::where([['user_id','=',$user->id],['badge_id','=',$m_badge->badge_id]])->count(); ?>
                                        @if($count >= $m_badge->number)
                                            <div class="col-4 badge-container text-center">
                                                <div class="badge-wrapper">
                                                    <img class="" src="{{asset("uploads/master-badges/$m_badge->pic")}}" alt="">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if($bage_no > 0)
                                    <div class="col-12 badge-all text-center">
                                        <button type="button" class="btn-all" data-toggle="modal" data-target="#all_badges">See All</button>
                                        <!--<a href="#">See All</a>-->
                                    </div>
                                    @else
                                        <h4 class="mt-0" style="color: #bdb7b7;font-size: 20px;">Add some experience to receive a badge</h4>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hackathon">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php $sn=0; ?>
                    @for ($i = $max; $i >= $min; $i--)
                        <?php
                            $sn++;
                        $experiences = \App\Experience::where("user_id",$user->id)->whereYear("from",$i)->get();
//                        dd($experiences);
//                        dd($user->experiences->whereYear("created_at",$i)->get());
                        ?>
                        @if($experiences->isNotEmpty() or $sn==1)
                            @if($sn == 1)
                                <div class="row">
                                    <div class="col hackathon_main_wrapper block_wrapper">
                                        <h2 class="block-title">@if($i == "1970"){{date("Y")}}@else{{$i}}@endif</h2>

                                        <button type="button" class="btn-plus" data-toggle="modal" data-target="#hackathon_add"><img alt="" src="{{asset("theme/hack4pizza/images/icon_plus.jpg")}}" /></button>

                                        @foreach($experiences as $experience)
                                            <div class="row hackathon_blocks align-items-center justify-content-center">

                                                <div class="col-12 hackathon_block">
                                                    <div class="hackathonblock_controls">
                                                        <button type="button" class="btn-edit" he_id="{{$experience->id}}" h_name="{{$experience->name}}" description="{{$experience->description}}" organized_by="{{$experience->organized_by}}"  from="{{$experience->from}}" to="{{$experience->to}}" pic="{{$experience->pic}}" badge="{{$experience->badge}}" src_pic="{{asset("uploads/hackonton/$experience->pic")}}" data-toggle="modal" data-target="#hackathon_edit"><img alt="" src="{{asset("theme/hack4pizza/images/icon_edit.jpg")}}" /></button>
                                                        <?php $id=$experience->id; ?>
                                                        <a href="#" onclick="event.preventDefault();del({{$id}});" class="btn-delete"><img alt="" src="{{asset("theme/hack4pizza/images/icon_delete.jpg")}}" /></a>
                                                    </div>
                                                    <div class="media">
                                                        @if($experience->pic)
                                                            <img class="mr-5 hackathon_cover" src="{{asset("uploads/hackonton/$experience->pic")}}" alt="" width="131">
                                                        @else
                                                            <img class="mr-5 hackathon_cover" src="{{asset("uploads/placeholder.png")}}" alt="" width="131">
                                                        @endif
                                                        <div class="media-body">
                                                            <h3 class="mt-0">
                                                                {{$experience->name}}
                                                                <div class="media hackathon_position">
                                                                    <img class="align-self-center" src="{{asset('uploads/badges/thumbs/'.$experience->badge->pic)}}" alt="">
                                                                    <span class="media-body color_3" style="color: {{$experience->badge->color}}">{{$experience->badge->name}}</span>
                                                                </div>

                                                            </h3>
                                                            <h4 class="mt-0">by {{$experience->organized_by}} <span class="hackathon_date">{{date("d-M-Y",strtotime($experience->from))}} - {{date("d-M-Y",strtotime($experience->to))}}</span></h4>
                                                            <p><?php echo $experience->description; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col hackathon_main_wrapper block_wrapper">
                                        <a class="block-title year_show" data-toggle="collapse" href="#hackathon_blocks_{{$i}}" role="button" aria-expanded="false" aria-controls="hackathon_blocks_{{$i}}">{{$i}}</a>

                                        <div class="row">
                                            <div class="col-12 hackathon_winBadges" id="hackathon_winBadges_{{$i}}">
                                                @foreach($badges as $badge)
                                                    <?php $count = \App\Experience::where([['user_id','=',$user->id],['badge_id','=', $badge->id]])->whereYear("from",$i)->count(); ?>
                                                    @if($count > 0)
                                                        <div class="media hackathon_position">
                                                            <span class="badges_count">x{{$count}}</span>
                                                            <img class="align-self-center" src="{{asset("uploads/badges/thumbs/$badge->pic")}}" alt="">
                                                            <span class="media-body color_3" style="color: {{$badge->color}}">{{$badge->name}}</span>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>

                                        <div class="collapse" id="hackathon_blocks_{{$i}}">


                                            @foreach($experiences as $experience)
                                                <div class="row hackathon_blocks align-items-center justify-content-center">

                                                    <div class="col-12 hackathon_block">
                                                        <div class="hackathonblock_controls">
                                                            <button type="button" class="btn-edit" he_id="{{$experience->id}}" h_name="{{$experience->name}}" description="{{$experience->description}}" organized_by="{{$experience->organized_by}}"  from="{{$experience->from}}" to="{{$experience->to}}" pic="{{$experience->pic}}" badge="{{$experience->badge}}" src_pic="{{asset("uploads/hackonton/$experience->pic")}}" data-toggle="modal" data-target="#hackathon_edit"><img alt="" src="{{asset("theme/hack4pizza/images/icon_edit.jpg")}}" /></button>
                                                            <?php $id=$experience->id; ?>
                                                            <a href="#" onclick="event.preventDefault();del({{$id}});" class="btn-delete"><img alt="" src="{{asset("theme/hack4pizza/images/icon_delete.jpg")}}" /></a>
                                                        </div>
                                                        <div class="media">
                                                            @if($experience->pic)
                                                                <img class="mr-5 hackathon_cover" src="{{asset("uploads/hackonton/$experience->pic")}}" alt="" width="131">
                                                            @else
                                                                <img class="mr-5 hackathon_cover" src="{{asset("uploads/placeholder.png")}}" alt="" width="131">
                                                            @endif
                                                            <div class="media-body">
                                                                <h3 class="mt-0">
                                                                    {{$experience->name}}
                                                                    <div class="media hackathon_position">
                                                                        <img class="align-self-center" src="{{asset('uploads/badges/thumbs/'.$experience->badge->pic)}}" alt="">
                                                                        <span class="media-body color_3" style="color: {{$experience->badge->color}}">{{$experience->badge->name}}</span>
                                                                    </div>

                                                                </h3>
                                                                <h4 class="mt-0">by {{$experience->organized_by}} <span class="hackathon_date">{{date("d-M-Y",strtotime($experience->from))}} - {{date("d-M-Y",strtotime($experience->to))}}</span></h4>
                                                                <p><?php echo $experience->description; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endfor


                </div>
            </div>
        </div>
    </div>
@endsection
@section('models')
    <div class="modal fade" id="profile_model" tabindex="-1" role="dialog" aria-labelledby="performance_modelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="block_wrapper">
                    <h2 class="block-title">Edit Profile</h2>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
                    <form id="profile_form" class="form_class" method="post" enctype="multipart/form-data">
                        <div class="form-group msg_name">
                            @csrf
                            <input type="hidden" id="pic" value="{{$user->pic}}">
                            <label>Name*</label>
                            <input type="hidden" id="id" value="{{$user->id}}">
                            <input type="text" name="name" class="form-control" value="<?php $user = Auth::user();echo $user->name;?>" id="name">
                        </div>
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea name="" id="bio"  class="form-control">{{$user->bio}}</textarea>
                        </div>
                        <div class="form-group msg_email">
                            <label>Email*</label>
                            <input type="email" class="form-control" id="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group msg_pass">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" placeholder="If you didnt want to change Password leave it blank">
                        </div>
                        <div class="form-group">
                            <label>Social Link Name</label>
                            <input type="text" class="form-control" {{$user->name1}} id="name1">
                        </div>
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" class="form-control" {{$user->url1}} id="url1">
                        </div>
                        <div class="form-group">
                            <label>Social Link Name</label>
                            <input type="text" class="form-control" {{$user->name2}} id="name2">
                        </div>
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" class="form-control" {{$user->url2}} id="url2">
                        </div>
                        <div class="form-group">
                            <label>Social Link Name</label>
                            <input type="text" class="form-control" {{$user->name3}} id="name3">
                        </div>
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" class="form-control" {{$user->url3}} id="url3">
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
                                @if($user->pic != null)
                                    <img src="{{asset("uploads/user-pic/$user->pic")}}" width="100%" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-right ">
                            <button type="button" id="profile_submit"  class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hackathon_add" tabindex="-1" role="dialog" aria-labelledby="hackathon_addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="block_wrapper">
                    <h2 class="block-title">Add Hackathon</h2>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
                    <form id="hackathon_add_form" class="form_class" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="ha_pic" >
                        <div class="form-group">
                            <label>Hackathon's name*</label>
                            <input type="text" class="form-control" id="ha_name">
                        </div>
                        <div class="form-group ha_organized">
                            <label>Hosted/Organized by*</label>
                            <input type="text" class="form-control" id="ha_organized">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 ha_from">
                                <label>From*</label>
                                <input type="text" class="form-control datepicker " id="ha_from">
                            </div>
                            <div class="form-group col-md-4">
                                <label>To*</label>
                                <input type="text" class="form-control datepicker" id="ha_to">
                            </div>
                            <div class="form-group col-md-4 place_msg">
                                <label>Result*</label>
                                <select class="form-control" id="ha_result">
                                    <option value="" selected></option>
                                    @foreach($badges as $badge)
                                        <option value="{{$badge->id}}">{{$badge->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description (HTML editor)*</label>
                            <textarea class="form-control" rows="5" id="ha_description"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Upload Hackathon's logo/IMG</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="hackathon_img">
                                    <label class="custom-file-label" for="hackathon_img"></label>
                                </div>

                            </div>
                            <div class="form-group col-sm-2 ha_pic_msg">

                            </div>

                        </div>
                        <div class="form-group text-right ha_success">
                        </div>
                        <div class="form-group text-right">
                            <button type="button" id="ha_submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hackathon_edit" tabindex="-1" role="dialog" aria-labelledby="hackathon_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="block_wrapper">
                    <h2 class="block-title">Edit Hackathon</h2>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
                    <form id="hackathon_edit_form" class="form_class" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf
                            <input type="hidden" id="he_pic">
                            <input type="hidden" id="he_id">
                            <label>Hackathon's name*</label>
                            <input type="text" class="form-control" id="he_name" >
                        </div>
                        <div class="form-group">
                            <label>Hosted/Organized by*</label>
                            <input type="text" class="form-control" id="he_organized" >
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>From*</label>
                                <input type="text" class="form-control datepicker" id="he_from" >
                            </div>
                            <div class="form-group col-md-4">
                                <label>To*</label>
                                <input type="text" class="form-control datepicker" id="he_to" >
                            </div>
                            <div class="form-group col-md-4" >
                                <label>Result*</label>
                                <select class="form-control" id="he_result">
                                    @foreach($badges as $badge)
                                        <option value="{{$badge->id}}">{{$badge->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description (HTML editor)*</label>
                            <textarea class="form-control"
                                      rows="5" id="he_description"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Upload Hackathon's logo/IMG</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="hackathon_img">
                                    <label class="custom-file-label" for="hackathon_img"></label>
                                </div>
                            </div>
                            <div class="form-group col-sm-2 he_pic_msg">

                            </div>
                            <div class="form-group col-sm-2 he_success">

                            </div>
                        </div>
                        <div class="form-group text-right">
                            {{--<a href="#" class="btn-delete"><img alt="" src="{{asset("theme/hack4pizza/images/icon_delete.jpg")}}" /></a>--}}
                            <button type="button" id="he_submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="performance_model" tabindex="-1" role="dialog" aria-labelledby="performance_modelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="block_wrapper">
                    <h2 class="block-title">Edit Performance</h2>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
                    <form id="performance_form" class="form_class">
                        <div class="form-group">
                            <input type="hidden" id="per_id" value="{{$user->performance->id or ''}}">
                            <label>Pitch Presentation</label>
                            <input type="number" value="{{$user->performance->pitch or '0'}}" class="form-control" id="pitch">
                        </div>
                        <div class="form-group">
                            <label>Front End*</label>
                            <input type="number" class="form-control" value="{{$user->performance->front_end or '0'}}" id="front_end">
                        </div>
                        <div class="form-group">
                            <label>Back End*</label>
                            <input type="number" class="form-control" value="{{$user->performance->back_end or '0'}}" id="back_end">
                        </div>
                        <div class="form-group">
                            <label>Team player*</label>
                            <input type="number" class="form-control" value="{{$user->performance->team_player or '0'}}" id="team_player">
                        </div>
                        <div class="form-group">
                            <label>Problem Solving*</label>
                            <input type="number" class="form-control" value="{{$user->performance->problem_solving or '0'}}" id="problem_solving">
                        </div>
                        <div class="form-group">
                            <label>UX Design*</label>
                            <input type="number" class="form-control"  value="{{$user->performance->ux_design or '0'}}" id="ux_design">
                        </div>
                        <div class="form-group per_success">
                        </div>
                        <div class="form-group text-right">
                            <button type="button" id="per_submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="all_badges" tabindex="-1" role="dialog" aria-labelledby="all_badgesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="block_wrapper row">
                    <h2 class="block-title">Badges</h2>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><img alt="" src="{{asset("theme/hack4pizza/images/icon_close.jpg")}}"></button>
                    @foreach($badges as $badge)
                        <?php $count = \App\Experience::where([['user_id','=',$user->id],['badge_id','=', $badge->id]])->count(); ?>
                        @if($count > 0)
                            <div class="col-xs-12 col-lg-6 badge_group">
                                <div class="media">
                                    <img class="align-self-center" alt="" src="{{asset("uploads/badges/$badge->pic")}}">
                                    <div class="media-body align-self-center">
                                        <h5 class="mt-0">{{$badge->name}}</h5>
                                        <p>{{$badge->description}}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xs-12 col-lg-6 badge_group badge_hide">
                                <div class="media">
                                    <img class="align-self-center" alt="" src="{{asset("uploads/badges/$badge->pic")}}">
                                    <div class="media-body align-self-center">
                                        <h5 class="mt-0">{{$badge->name}}</h5>
                                        <p>{{$badge->description}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @foreach($m_badges as $m_badge)
                        <?php $count = \App\Experience::where([['user_id','=',$user->id],['badge_id','=', $m_badge->badge_id]])->count(); ?>
                        @if($count >= $m_badge->number)
                            <div class="col-xs-12 col-lg-6 badge_group">
                                <div class="media">
                                    <img class="align-self-center" alt="" src="{{asset("uploads/master-badges/$m_badge->pic")}}">
                                    <div class="media-body align-self-center">
                                        <h5 class="mt-0">{{$m_badge->name}}</h5>
                                        <p>{{$m_badge->description}}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xs-12 col-lg-6 badge_group badge_hide">
                                <div class="media">
                                    <img class="align-self-center" alt="" src="{{asset("uploads/master-badges/$m_badge->pic")}}">
                                    <div class="media-body align-self-center">
                                        <h5 class="mt-0">{{$m_badge->name}}</h5>
                                        <p>{{$m_badge->description}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection
@section("scripts")
    <script src="{{asset('admin/assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin/assets/datatable/dataTables.responsive.min.js')}}"></script>
    <script>
        /**  Show Radar Chart  **/
        function del(id){
            swal({
                    title: "Are you sure?",
                    text: "This Hackthon will be deleted permanently",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL+"/hackonthon-delete/delete/"+id;
                });

        }
        window.chartColors = {
            red: 'rgb(244, 132, 70)'
        };

        var color = Chart.helpers.color;
        var config = {
            type: 'radar',
            data: {
                labels: [
                    "Pitch Presentation ", "Front End ", "Back End ", "Team player ", "Problem Solving ", "UX Design "
                ],
                datasets: [{
                    label: 'Performance',
                    backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
                    borderColor: window.chartColors.red,
                    pointBackgroundColor: window.chartColors.red,
                    data: [{{$user->performance->pitch or '0'}},
                        {{$user->performance->front_end or '0'}},
                        {{$user->performance->back_end or '0'}},
                        {{$user->performance->team_player or '0'}},
                        {{$user->performance->problem_solving or '0'}},
                        {{$user->performance->ux_design or '0'}}],
                    notes: ["none", "none", "none", "none", "none", "none"]
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                title: {
                    display: false,
                },
                scale: {
                    ticks: {
                        beginAtZero: true
                    },
                    Axes: [{
                        display: false //this will remove all the x-axis grid lines
                    }]
                }
            }
        };
        window.onload = function() {
            window.myRadar = new Chart(document.getElementById("canvas"), config);
        };
        var colorNames = Object.keys(window.chartColors);

        $(function() {

            /** Show Hide Hackathon blocks **/
            $('#hackathon_blocks_2018').on('show.bs.collapse', function() {
                $('#hackathon_winBadges_2018').hide();
            });
            $('#hackathon_blocks_2018').on('hide.bs.collapse', function() {
                $('#hackathon_winBadges_2018').show();
            })

            /** Get Selected File name fileinput **/
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            /** datetimepicker **/
            $('.datepicker').datetimepicker({
                format: 'D/M/YYYY',
                widgetPositioning: {
                    horizontal: "auto",
                    vertical: "bottom"
                }
            });

        });
        $(".year_show").click(function () {
            $(this).parent().find(".hackathon_winBadges").toggle();
        });
        $(".hackathon_winBadges").click(function () {
           $(this).hide();
           $(this).parent().parent().find(".collapse").addClass("show");
        });
    </script>
    <script type="text/javascript">
        $("#profile_submit").click(function () {
            $.LoadingOverlay("show");
            $("#signup_model").find('.umsg').remove();
            $("#signup_model").find('.emsg').remove();
            $("#signup_model").find('.pmsg').remove();
            $("#signup_model").find('.smsg').remove();
            var token = $("input[name=_token]").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var pic = $("#pic").val();
            var password = $("#password").val();
            var name1 = $("#name1").val();
            var name2 = $("#name2").val();
            var name3 = $("#name3").val();
            var url1 = $("#url1").val();
            var url2 = $("#url2").val();
            var url3 = $("#url3").val();
            var id = $("#id").val();
            var bio = $("#bio").val();
            $.ajax({
                type: 'POST',
                url: "{{route("user-update")}}",
                data: {_token: token, name: name, email: email, password: password, bio: bio, name1: name1,name2: name2,name3: name3,url1: url1,url2: url2,url3: url3, id: id, pic: pic},
                dataType: 'JSON',
                success: function (resp) {
                    $.LoadingOverlay("hide");
                    if (resp.status == 0) {
                        $('<span class="smsg">Congrats..Your Profile has been Updated!</span>').appendTo(".success-msg").css('color', 'green');
                        var delay = 1000; //Your delay in milliseconds
                        setTimeout(function () {
                            window.location = '/user/dashboard';
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

                },

            });
        });
        $("#ha_submit").click(function () {
            $.LoadingOverlay("show");
            $("#hackathon_add").find('.emsg').remove();
            var token = $("input[name=_token]").val();
            var name = $("#ha_name").val();
            var organized_by = $("#ha_organized").val();
            var from = $("#ha_from").val();
            var to = $("#ha_to").val();
            var result = $("#ha_result").val();
            var description = $("#ha_description").val();
            var pic = $("#ha_pic").val();
            $.ajax({
                type: 'POST',
                url: "{{route("add-hackonton")}}",
                data: {_token: token, name: name, organized_by: organized_by, from: from, to: to, result: result, description: description, pic: pic},
                dataType: 'JSON',
                success: function (resp) {
                    $.LoadingOverlay("hide");
                    if (resp.status == 0) {
                        $('<span class="emsg">Congrats..Your Hackonton has been Added!</span>').appendTo(".ha_success").css('color', 'green');
                        var delay = 1000; //Your delay in milliseconds
                        setTimeout(function () {
                            window.location = '/user/dashboard';
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
        $("#he_submit").click(function () {
            $.LoadingOverlay("show");
            $("#hackathon_edit").find('.emsg').remove();
            var token = $("input[name=_token]").val();
            var name = $("#he_name").val();
            var organized_by = $("#he_organized").val();
            var from = $("#he_from").val();
            var to = $("#he_to").val();
            var result = $("#he_result").val();
            var description = $("#he_description").val();
            var pic = $("#he_pic").val();
            var id = $("#he_id").val();
            $.ajax({
                type: 'POST',
                url: "{{route("update-hackonton")}}",
                data: {_token: token, name: name, organized_by: organized_by, from: from, to: to, result: result, description: description, pic: pic, id: id},
                dataType: 'JSON',
                success: function (resp) {
                    $.LoadingOverlay("hide");
                    if (resp.status == 0) {
                        $('<span class="emsg">Congrats..Your Hackonton has been Updated!</span>').appendTo(".he_success").css('color', 'green');
                        var delay = 1000; //Your delay in milliseconds
                        setTimeout(function () {
                            window.location = '/user/dashboard';
                        }, delay);
                    } else {
                        if (typeof resp.name != "undefined") {
                            $("#he_name").parent().append('<span class="emsg">' + resp.name + '</span>').css('color', 'red');
                        }
                        if (typeof resp.description != "undefined") {
                            $("#he_description").parent().append('<span class="emsg">' + resp.description + '</span>').css('color', 'red');
                        }
                        if (typeof resp.result != "undefined") {
                            $("#he_result").parent().append('<span class="emsg">' + resp.result + '</span>').css('color', 'red');
                        }
                        if (typeof resp.from != "undefined") {
                            $("#he_from").parent().append('<span class="emsg">' + resp.from + '</span>').css('color', 'red');
                        }
                        if (typeof resp.to != "undefined") {
                            $("#he_to").parent().append('<span class="emsg">' + resp.to + '</span>').css('color', 'red');
                        }
                        if (typeof resp.organized_by != "undefined") {
                            $("#he_organized").parent().append('<span class="emsg">' + resp.organized_by + '</span>').css('color', 'red');
                        }


                    }

                },

            });
        });
        $("#per_submit").click(function () {
            $.LoadingOverlay("show");
            $("#performance_model").find('.emsg').remove();
            var token = $("input[name=_token]").val();
            var pitch = $("#pitch").val();
            var front_end = $("#front_end").val();
            var back_end = $("#back_end").val();
            var team_player = $("#team_player").val();
            var ux_design = $("#ux_design").val();
            var problem_solving = $("#problem_solving").val();
            var id = $("#per_id").val();
            $.ajax({
                type: 'POST',
                url: "{{route("update-performance")}}",
                data: {_token: token, pitch: pitch, front_end: front_end, back_end: back_end, team_player: team_player, ux_design: ux_design, problem_solving: problem_solving,id: id,},
                dataType: 'JSON',
                success: function (resp) {
                    $.LoadingOverlay("hide");
                    if (resp.status == 0) {
                        $('<span class="emsg">Congrats..Your Hackonton has been Updated!</span>').appendTo(".per_success").css('color', 'green');
                        var delay = 1000; //Your delay in milliseconds
                        setTimeout(function () {
                            window.location = '/user/dashboard';
                        }, delay);
                    } else {
                        if (typeof resp.pitch != "undefined") {
                            $("#pitch").parent().append('<span class="emsg">' + resp.pitch + '</span>').css('color', 'red');
                        }
                        if (typeof resp.front_end != "undefined") {
                            $("#front_end").parent().append('<span class="emsg">' + resp.front_end + '</span>').css('color', 'red');
                        }
                        if (typeof resp.back_end != "undefined") {
                            $("#back_end").parent().append('<span class="emsg">' + resp.back_end + '</span>').css('color', 'red');
                        }
                        if (typeof resp.team_player != "undefined") {
                            $("#team_player").parent().append('<span class="emsg">' + resp.team_player + '</span>').css('color', 'red');
                        }
                        if (typeof resp.ux_design != "undefined") {
                            $("#ux_design").parent().append('<span class="emsg">' + resp.ux_design + '</span>').css('color', 'red');
                        }
                        if (typeof resp.problem_solving != "undefined") {
                            $("#problem_solving").parent().append('<span class="emsg">' + resp.problem_solving + '</span>').css('color', 'red');
                        }


                    }

                },

            });
        });
        $('#profile_form').on('change','.custom-file-input', function(event){
            $.LoadingOverlay("show");
            var form = $('form#profile_form')[0];
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
                        $(".pic_msg").append(data.uploaded_image);
                    }
                    // $('#message').css('display', 'block');
                    // $('#message').html(data.message);
                    // $('#message').addClass(data.class_name);
                    // $('#uploaded_image').html(data.uploaded_image);
                }
            })
        });
        $('#hackathon_add_form').on('change','.custom-file-input', function(event){
            $.LoadingOverlay("show");
            var form = $('form#hackathon_add_form')[0];
            event.preventDefault();
            $.ajax({
                url:"{{ route('ajaxuploadhackon.action') }}",
                method:"POST",
                data:new FormData(form),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    $.LoadingOverlay("hide");
                    $(".ha_pic_msg").children().remove();
                    $("#ha_pic").val(data.pic);

                    if (data.pic == ""){
                        $('<span class="umsg">' + data.massage + '</span>').appendTo(".ha_pic_msg").css('color', 'red');
                    }else{
                        $(".ha_pic_msg").append(data.uploaded_image);
                    }
                    // $('#message').css('display', 'block');
                    // $('#message').html(data.message);
                    // $('#message').addClass(data.class_name);
                    // $('#uploaded_image').html(data.uploaded_image);
                }
            })
        });
        $('#hackathon_edit_form').on('change','.custom-file-input', function(event){
            $.LoadingOverlay("show");
            var form = $('form#hackathon_edit_form')[0];
            event.preventDefault();
            $.ajax({
                url:"{{ route('ajaxuploadhackon.action') }}",
                method:"POST",
                data:new FormData(form),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                    $.LoadingOverlay("hide");
                    $(".he_pic_msg").children().remove();
                    $("#he_pic").val(data.pic);

                    if (data.pic == ""){
                        $('<span class="umsg">' + data.massage + '</span>').appendTo(".he_pic_msg").css('color', 'red');
                    }else{
                        $(".he_pic_msg").append(data.uploaded_image);
                    }
                    // $('#message').css('display', 'block');
                    // $('#message').html(data.message);
                    // $('#message').addClass(data.class_name);
                    // $('#uploaded_image').html(data.uploaded_image);
                }
            })
        });
        $(
            ".btn-edit").click(function () {
           var pic = $(this).attr("pic");
           var description = $(this).attr("description");
           var from = $(this).attr("from");
           var to = $(this).attr("to");
           var organized_by = $(this).attr("organized_by");
           var badge = $(this).attr("badge");
           var name = $(this).attr("h_name");
           var id = $(this).attr("he_id");
           var src_pic = $(this).attr("src_pic");
           src_pic = "<img width='100%' src="+src_pic+">";
           $("#he_pic").val(pic);
           $("#he_description").val(description);
           $("#he_from").val(from);
           $("#he_to").val(to);
           $("#he_organized").val(organized_by);
           $("#he_badge").val(badge);
           $("#he_name").val(name);
           $("#he_id").val(id);
           $(".he_pic_msg").html(src_pic);

        });
    </script>

@endsection
