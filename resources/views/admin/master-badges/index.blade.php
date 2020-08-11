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
                <h4 class="page-title">{{Request::segment(2)}}</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="{{route(Request::segment(2).".index")}}" style="text-transform: capitalize">{{Request::segment(2)}}</a></li>
                    <li class="active" style="text-transform: capitalize">{{Request::segment(2)}} List</li>
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
                    <div class="panel-heading" style="text-transform: capitalize">Manage {{Request::segment(2)}} <button class="btn btn-danger pull-right" onclick="del_selected()">Delete All</button> <a href="{{route('master-badges.create')}}" class="btn btn-info pull-right" style="margin-right: 10px">Add New</a></div>
                    <div class="col-sm-12" style="background-color: white">
                        <div class="table-responsive">
                            <form action="{{url('admin/delete-selected-master-badges')}}" method="post" id="uform">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <table id="badge" class="table table-hover manage-u-table table-bordered table-responsive table-striped">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" class="ace" /></th>
                                        <th>Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>

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
    <!-- Modal -->
    <div class="modal fade" id="empModal" role="dialog">
        <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Badge Detail</h4>
            </div>
            <div class="modal-body">

            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

@section('scripts')
    <script src="{{asset('admin/assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin/assets/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/datatable/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript">
        function del(id){
            swal({
                    title: "Are you sure?",
                    text: "This Service will be deleted permanently",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    var APP_URL = {!! json_encode(url('/')) !!}

                        window.location.href = APP_URL+"/admin/master-badges/delete/"+id;
                });

        }
        function del_selected(){
            swal({
                title: "Are you sure?",
                text: "These badge/badges will be deleted permanently",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $("#uform").submit();
                setTimeout(function () {
                    swal("Badge deleted sucessfully. Thanks");
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

        var copoun = $('#badge').DataTable( {
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": {
                "url":"{{ route('admin-getAddedMasterBadges') }}",
                "dataType":"json",
                "type":"POST",
                "data":{"_token":"<?php echo csrf_token() ?>"}
            },
            "columns":[
                {"data":"select","searchable":false,"orderable":false},
                {"data":"name"},
                {"data":"action","searchable":false,"orderable":false}
            ]
        } );
        function view(id) {



            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.post("{{ route('admin-getMasterBadges') }}", {_token: CSRF_TOKEN, id: id}).done(function (response) {

                // Add response in Modal body
                $('.modal-body').html(response);

                // Display Modal
                $('#empModal').modal('show');

            });

        }
    </script>
@endsection




@stop



