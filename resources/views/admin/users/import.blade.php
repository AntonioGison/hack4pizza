@extends('admin.layouts.master')
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
                    <li><a href="{{route("users.index")}}" style="text-transform: capitalize">{{Request::segment(2)}}</a></li>
                    <li class="active" style="text-transform: capitalize">Import Excel</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">Import Excel </div>
                    <div class="col-sm-12" style="background-color: white">
                        {{ Form::open([ 'route' => 'users-import-store','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data']) }}
                        <div class="col-sm-4 col-md-offset-4">
                            <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                {!! Form::label('Upload File:') !!}
                                {{ Form::file('file', null, ['class' => 'form-control','id'=>'category']) }}
                                <span class="text-danger">{{ $errors->first('file') }}</span>
                            </div>
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-xs-12 text-center">
                                <a class="btn btn-danger btn-sm" href="{{ route('users.index') }}">
                                    <i class="ace-icon fa fa-reply icon-only"></i> Back
                                </a>
                                {{ Form::submit('Update', ['class' => 'btn btn-sm btn btn-info', 'title'=>'Click here to Save']) }}
                            </div>
                        </div>
                        {{Form::close()}}
                        <div class="form-group"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>


@stop


