@extends('layouts.master')

@section('dish-active','active')
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
                                    <h3 class="card-title">Dishes</h3>
                                    <a href="/dish/create" class="btn btn-success btn-sm">Create</a>
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
                                            <th>Category Name</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dishes as $dish)
                                        <tr>
                                            <td>{{$dish->name}}</td>
                                            <td>{{$dish->category->name}}</td>
                                            <td>{{$dish->created_at}}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="/dish/{{$dish->id}}/edit" class="btn btn-warning m-1">Edit</a>
                                                    <form action="/dish/{{$dish->id}}" class="m-0" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                                    </form>
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
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 10,
            });
        });
    </script>
