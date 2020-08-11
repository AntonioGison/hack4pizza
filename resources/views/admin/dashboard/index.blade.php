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
                <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="{{route("admin.dashboard")}}" style="text-transform: capitalize">Dashboard</a></li>
                    <li class="active" style="text-transform: capitalize">Edit Message</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">Welcome to dashboard !</div>
                    <div class="col-sm-12" style="background-color: white">

                        <div class="form-group"></div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
