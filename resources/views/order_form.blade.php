<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <!-- Google Font: Source Sans Pro -->
    <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css" />
</head>
<body>
    <div class="card">
        <div class="card-body">
            @if (session('message'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{session('message')}}
            </div>
            @endif
            <h3>Order Form</h3>
            <!-- ./row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">New Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Order List</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="row">
                                        <div class="col-4">
                                            <form action="{{route('order.search')}}" method="GET" role="search" class="mb-4">
                                                <div class="d-flex">
                                                    <input type="text" name="search" class="form-control m-1" placeholder="Search Dish ...">
                                                    <button type="submit" class="btn btn-secondary m-1">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <form action="{{route("order.submit")}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            @foreach ($dishes as $dish)
                                            <div class="col-md-3">
                                                <img src="{{asset('images/'.$dish->image)}}" class="card-img-top mb-2" alt="image">
                                                <h5 class="card-title mb-2">{{$dish->name}}</h5>
                                                <div class="mb-2">
                                                    <input type="number" name="{{$dish->id}}" class="form-control"/>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            <select name="table_id" class="form-control" >
                                                <option value="">Select Table</option>
                                                @foreach ($tables as $table)
                                                <option value="{{$table->id}}">{{$table->number}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
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
                                                @if ($status[$order->status] === 'Cancel')
                                                <td class="table-danger">{{$status[$order->status]}}</td>
                                                <td>
                                                    <a href="{{route('order.delete',$order->id)}}" class="btn btn-danger m-1">Delete</a>
                                                </td>
                                                @else
                                                <td class="table-success">{{$status[$order->status]}}</td>
                                                <td>
                                                    <a href="{{route('order.serve',$order->id)}}" class="btn btn-info m-1">Serve</a>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</body>
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</html>
