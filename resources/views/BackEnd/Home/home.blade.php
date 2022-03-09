@extends('BackEnd.master')
@section('title')
    Home Page
@endsection
<?php
    $months = array();
    $count = 0;
    while($count <= 3) {
        $months[] = date('M Y', strtotime("-".$count." month"));
        $count++;
    }

    $dataPoints = array(
        array("y" => $ordersCount[3], "label" => $months[3]),
        array("y" => $ordersCount[2], "label" => $months[2]),
        array("y" => $ordersCount[1], "label" => $months[1]),
        array("y" => $ordersCount[0], "label" => $months[0]),
    );
?>

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- <h3 class="title_thongke text-center mb-3"><b>Trang chủ quản trị</b></h3> -->
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$order_count}}</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('show_order')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$cus_count}}</h3>

                    <p>New Customers</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('show_customer')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$user_count}}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('manage_user')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$product_count}}</h3>

                    <p>Dish</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('manage_dish')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        
    </section>

    <div class="card-body">
        <!-- <form autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Từ ngày</label>
                        <input type="text" id="datepicker" class="form-control"><br>
                        <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Đến ngày</label>
                        <input type="text" id="datepicker2" class="form-control">
                    </div>
                </div>
            </div>
        </form> -->

        <!-- view charts orders -->
        <div class="col-md-12">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
        <br>

        <h3 class="text-center">Đơn hàng mới</h3>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($orders as $rd)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$rd->name}}</td>
                    <td>{{$rd->order_date}}</td>
                </tr> 
                @endforeach  
            </tbody>
            
        </table>
    </div>

@endsection

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: "Orders Report"
        },
        axisY: {
            title: "Number of Orders"
        },
        data: [{        
            // type: "column",
            type: "line",
            showInLegend: true, 
            legendMarkerColor: "grey",
            yValueFormatString: "#, ##0.## orders",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        
        }]
    });
    chart.render();
    };

</script>


