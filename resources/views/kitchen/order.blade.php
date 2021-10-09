@extends('layouts.master')

@section('order-active','active')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kitchen Panel</h1>
                </div>
            </div>
                <!-- /.row -->
        </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Orders</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{session('message')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                <table id="dishes" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Dish Name</th>
                                            <th>Table Number</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->dish->name}}</td>
                                            <td>{{$order->table_id}}</td>
                                            <td>{{$status[$order->status]}}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('order.approve',$order->id)}}" class="btn btn-warning m-1">Approve</a>
                                                    <a href="{{route('order.cancel',$order->id)}}" class="btn btn-danger m-1">Cancel</a>
                                                    <a href="{{route('order.ready',$order->id)}}" class="btn btn-success m-1">Ready</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @endsection
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script>
        $(function () {
            $('#dishes').DataTable({
                "paging": true,
                "searching": false,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 5,
            });
        });
    </script>
