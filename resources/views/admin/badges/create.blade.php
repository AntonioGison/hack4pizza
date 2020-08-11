@extends('admin.layouts.master')
@section('stylesheets')
    <link href="{{asset('admin/assets/css/summernote/summernote.css')}}" rel="stylesheet">
    {{--<link href="{{asset('admin/assets/css/summernote/summernote-bs3.css')}}" rel="stylesheet">--}}
    <link href="{{asset('admin/assets/css/select2.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/simple-iconpicker.min.css')}}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/summernote/summernote.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('admin/assets/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/simple-iconpicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $(function () {
                $('.color-picker').colorpicker();
            });
            $('.icon-picker').iconpicker(".icon-picker");

        });


    </script>
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
                        {{ Form::open([ 'route' => 'badges.store','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data']) }}

                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                {!! Form::label('Name:') !!}
                                {{ Form::text('name', null, ['class' => 'form-control','id'=>'category']) }}
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                        </div>


                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                {!! Form::label('Description:') !!}
                                {{ Form::textarea('description', null, ['class' => 'form-control','id'=>'category']) }}
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
                                {!! Form::label('Color:') !!}
                                {{ Form::text('color', null, ['class' => 'form-control colorpicker','id'=>'category']) }}
                                <span class="text-danger">{{ $errors->first('color') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group {{ $errors->has('pic') ? 'has-error' : '' }}">
                                {!! Form::label('Image:') !!}
                                {{ Form::file('pic', null, ['class' => 'form-control ',]) }}
                                <span class="text-danger">{{ $errors->first('pic') }}</span>
                            </div>
                        </div>









                        <div class="clearfix form-actions">
                            <div class="col-xs-12 text-center">
                                <a class="btn btn-danger btn-sm" href="{{ route('badges.index') }}">
                                    <i class="ace-icon fa fa-reply icon-only"></i> Back
                                </a>
                                {{ Form::submit('Save', ['class' => 'btn btn-sm btn btn-info', 'title'=>'Click here to Save']) }}
                            </div>
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

