@extends('admin.layouts.master')
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
                    <li class="active">Users List</li>
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
                    <div class="panel-heading">MANAGE USERS </div>
                    <div class="col-sm-12" style="background-color: white">
                        <div class="row" style="margin-bottom: 15px">
                            <div class="col-sm-12">
                                <div class="col-sm-12" >
                                    @if(Auth::user()->role==0) <button class="btn btn-danger pull-right" style="margin-right: 10px;margin-top: 15px" onclick="del_selected()">Delete All</button> <a style="margin-right: 10px;margin-top: 15px" href="{{route('users.create')}}" class="btn btn-info pull-right" style="margin-right: 10px">Add New</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <form action="{{url('admin/delete-selected-users')}}" method="post" id="uform">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <table id="users" class="table table-hover manage-u-table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="ace" /></th>
                                            <th>NAME</th>
                                            <th>Email</th>
                                            <th>Created at</th>

                                            <th style="width: 300px">Action</th>
                                        </tr>
                                    </thead>
                                {{--<tbody>--}}
                                {{--<tr>--}}
                                {{--<td class="text-center">1</td>--}}
                                {{--<td><span class="font-medium">Daniel Kristeen</span>--}}
                                {{--<br/><span class="text-muted">Texas, Unitedd states</span></td>--}}
                                {{--<td>Visual Designer--}}
                                {{--<br/><span class="text-muted">Past : teacher</span></td>--}}
                                {{--<td>daniel@website.com--}}
                                {{--<br/><span class="text-muted">999 - 444 - 555</span></td>--}}
                                {{--<td>15 Mar 1988--}}
                                {{--<br/><span class="text-muted">10: 55 AM</span></td>--}}
                                {{--<td>--}}
                                {{--<select class="form-control">--}}
                                {{--<option>Modulator</option>--}}
                                {{--<option>Admin</option>--}}
                                {{--<option>User</option>--}}
                                {{--<option>Subscriber</option>--}}
                                {{--</select>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                {{--<button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="ti-key"></i></button>--}}
                                {{--<button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="icon-trash"></i></button>--}}
                                {{--<button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i class="ti-pencil-alt"></i></button>--}}
                                {{--<button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-20"><i class="ti-upload"></i></button>--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                                {{----}}
                                {{--</tbody>--}}
                                </table>
                            </form>
                        </div>
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
    {{--<div class="page-header">--}}
        {{--<h1>--}}
            {{--Manage Users--}}
            {{--<small>--}}
                {{--<i class="ace-icon fa fa-angle-double-right">--}}
                {{--</i>--}}
                {{--Registered Users--}}
            {{--</small>--}}
        {{--</h1>--}}
    {{--</div>--}}
    {{--<div class="table-responsive">--}}
        {{--<div class="col-lg-12 zero-padding">--}}
            {{--<h3>--}}
                {{--<a class="btn btn-primary btn-sm" href="{{route('users.create')}}">--}}
                    {{--Add New--}}
                {{--</a>--}}
            {{--</h3>--}}

            {{--<div class="table-header">--}}
                {{--Registered Users--}}
            {{--</div>--}}

                {{--<table id="users" class="display responsive nowrap" style="width:100%">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>Name</th>--}}
                        {{--<th>Email</th>--}}
                        {{--<th>Created at</th>--}}
                        {{--<th class="text-center">Action</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}

                {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}
@section('scripts')
    <script src="{{asset('admin/assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin/assets/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/datatable/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript">
        function del(id){
            swal({
                        title: "Are you sure?",
                        text: "This user will be deleted permanently",
                        type: "error",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        var APP_URL = {!! json_encode(url('/')) !!}

                                window.location.href = APP_URL+"/admin/users/delete/"+id;
                    });

        }
        function del_selected(){
            swal({
                title: "Are you sure?",
                text: "These user/users will be deleted permanently",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $("#uform").submit();
                setTimeout(function () {
                    swal("Users deleted sucessfully. Thanks");
                }, 2000);
            });
        }
    </script>

    <script>

        $(document).on('click', 'th input:checkbox', function () {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function () {
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });
        });
        /*$(document).ready(function () {
            $('.delete-all').on('click', function () {
                var conf = confirm('Are you sure? You want to delete it.');
                if (conf == true) {
                    $("#uform").submit();
                }
            });
        });*/

        var users = $('#users').DataTable( {
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url":"{{ route('admin.getUsers') }}",
                "dataType":"json",
                "type":"POST",
                "data":{"_token":"<?php echo csrf_token() ?>"}
            },
            "columns":[
                {"data":"select","searchable":false,"orderable":false},
                {"data":"name"},
                {"data":"email"},
                {"data":"created_at"},
                {"data":"action","searchable":false,"orderable":false}
            ]
        } );
    </script>
@endsection




@stop
