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
                <h4 class="page-title">Users</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="{{route('users.index')}}">Users</a></li>
                    <li class="active">Add New User</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- ============================================================== -->
        <!-- Other sales widgets -->
        <!-- ============================================================== -->
        <!-- .row -->

        <!-- /.row -->
        <!-- ============================================================== -->
        <!-- Extra-component -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- city-weather -->
        <!-- ============================================================== -->

        <!-- .row -->

        <!-- /.row -->
        <!-- ============================================================== -->
        <!-- Demo table -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">Add USER </div>
                    <div class="col-sm-12" style="background-color: white">
                        {{ Form::open([ 'route' => 'users.store','class'=>'form-horizontal','role'=>'form']) }}
                        <div class="col-sm-4 col-md-offset-4">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                {!! Form::label('Name:') !!}
                                {{ Form::text('name', null, ['class' => 'form-control','id'=>'name','placeholder'=>'Enter Name']) }}

                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-offset-4">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                {!! Form::label('Email:') !!}
                                {{ Form::email('email', null, ['class' => 'form-control','id'=>'email','placeholder'=>'Enter Email Address']) }}
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-offset-4">
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                {!! Form::label('Password:') !!}
                                {{ Form::text('password', null,['class' => 'form-control','id'=>'password','placeholder'=>'Enter Password ']) }}
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                        </div>


                        <div class="clearfix form-actions">
                            <div class="col-xs-12 text-center">
                                <a class="btn btn-danger btn-sm" href="{{ route('users.index') }}">
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
