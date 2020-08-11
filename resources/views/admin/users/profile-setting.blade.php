@extends('admin.layouts.master')
@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="page-header">
        <h1>
            Users Management
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Edit User
            </small>
        </h1>
    </div>
    {{ Form::model($user, ['method' => 'PATCH','route' => ['admin.update', $user->id],'class'=>'form-horizontal','role'=>'form']) }}
    <div class="form-group">
        {{ Form::label('Name', 'Name: *', ['for'=>'Name','class' => 'col-sm-3 control-label no-padding-right']) }}
        <div class="col-sm-9">
            {{ Form::text('name', null, ['class' => 'col-xs-10 col-sm-5','id'=>'name','placeholder'=>'Enter Name']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('Email', 'Email: *', ['for'=>'Email','class' => 'col-sm-3 control-label no-padding-right']) }}
        <div class="col-sm-9">
            {{ Form::email('email', null, ['class' => 'col-xs-10 col-sm-5','id'=>'email','placeholder'=>'Enter Email Address']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password: *', ['for'=>'password','class' => 'col-sm-3 control-label no-padding-right']) }}
        <div class="col-sm-9">
            {{ Form::text('password','', ['class' => 'col-xs-10 col-sm-5','id'=>'password','title'=>'']) }}
            <i style="cursor: pointer;" class="fa fa-question-circle fa-2x" title="If you want to change password then enter new password otherwise leave empty this field.Thanks" aria-hidden="true"></i>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('Disable', 'Active:', ['for'=>'options','class' => 'col-sm-3 control-label no-padding-right']) }}
        <div class="col-sm-9">
            <?php
            if ($user->status == "1") {
                $checked = "true";
                $val = "1";
            } else if ($user->status == "0") {
                $checked = "";
                $val = "0";
            } else {
                $checked = "false";
                $val = "";
            }
            ?>
            {{ Form::checkbox('status',$val,$checked,['class' => 'ace ace-switch ace-switch-5','id'=>'options']) }}
            <span class="lbl"></span>
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
@stop