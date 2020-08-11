@extends('admin.layouts.master')
@section('stylesheets')
    <style>
        .asColorPicker-trigger {
            cursor: pointer;
            width: 38px;
            height: 38px;
            position: absolute;
            right: 0px;
        }
    </style>

@endsection
@section('content')
    @if(Session::has('success_message'))
        <div class="alert alert-success">
            {{ Session::get('success_message') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">{{Request::segment(2)}}</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="{{route(Request::segment(2).".index")}}" style="text-transform: capitalize">{{Request::segment(2)}}</a></li>
                    <li class="active" style="text-transform: capitalize">Add New {{Request::segment(2)}}</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading" style="text-transform: capitalize">Add {{Request::segment(2)}} </div>
                    <div class="col-sm-12 " style="background-color: white">
                        {{ Form::open([ 'route' => 'settings.store','class'=>'form-horizontal', 'enctype'=>'multipart/form-data', 'role'=>'form']) }}

                        @foreach($all_columns as $column)

                            @if($column['type']=="file")
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">{{$column['label']}}</label>
                                    <div class="col-lg-8">
                                        <?php
                                        if(isset($settings[$column['name']])){
                                            $settings[$column['name']] = $settings[$column['name']];
                                        }else {
                                            $settings[$column['name']]='abc.png';
                                        }
                                        ?>
                                        <input type="file" name="{{$column['name']}}" class="{{$column['class']}}" id="{{$column['id']}}">
                                        @if(File::exists('uploads/'.$settings[$column['name']]))
                                            <img src="{{asset('uploads/'.$settings[$column['name']])}}" style="{{$column['style']}}" alt="{{$column['name']}} is not found" />
                                        @else
                                            <img src="{{asset('uploads/placeholder.jpg')}}" style="{{$column['style']}}" alt="{{$column['name']}} is not found"/>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if($column['type']=="textfield")
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">{{$column['label']}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="{{$column['name']}}" placeholder="{{$column['place_holder']}}" value="{{ isset($settings[$column['name']]) ? $settings[$column['name']] : ''}}" class="{{$column['class']}}" id="{{$column['id']}}">
                                    </div>
                                </div>
                            @endif
                            @if($column['type']=="textarea")
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">{{$column['label']}}</label>
                                    <div class="col-lg-8">
                                        <textarea name="{{$column['name']}}" class="{{$column['class']}}"   placeholder="{{$column['place_holder']}}" id="{{$column['id']}}">{{ isset($settings[$column['name']]) ? $settings[$column['name']] : ''}}</textarea>
                                    </div>

                                </div>
                            @endif
                            @if($column['type']=="checkbox")
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">{{$column['label']}}</label>

                                    <div class="span3">
                                        <label>
                                            <input type="checkbox" name="{{$column['name']}}" class="{{$column['class']}}" <?php if (isset($settings[$column['name']]) and $settings[$column['name']] == "1"){ echo "checked"; } ?>  id="{{$column['id']}}" data-color="#13dafe" data-size="small" />

                                            <span class="lbl"></span>
                                        </label>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                        <div class="col-xs-10 text-center" style="margin-bottom: 15px;">
                            <a class="btn btn-danger btn-sm" href="{{ url('admin/dashboard') }}">
                                <i class="ace-icon fa fa-reply icon-only"></i> Back
                            </a>
                            {{ Form::submit('Save', ['class' => 'btn btn-sm btn btn-info', 'title'=>'Click here to Save']) }}
                        </div>
                        {{Form::close()}}
                        <div class="form-group"></div>
                    </div>

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->

        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>

@stop

