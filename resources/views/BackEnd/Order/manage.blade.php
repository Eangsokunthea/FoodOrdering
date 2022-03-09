@extends('BackEnd.master')
@section('title')
    Order Manage
@endsection

@section('content')
<div class="card">                                                                       
    <div class="card-header">
    <h3 class="card-title">Order Manage</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Order Total</th>
                    <th>Payment Type</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($orders as $orde)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$orde->name}}</td>
                    <td>{{$orde->order_total}}$</td>
                    <td>{{$orde->payment_status}}</td>
                    <td>{{$orde->order_date}}</td>
                    <td>
                        {{$orde->order_status}}
                        <!-- @if($orde->order_status==1)
                            Đơn hàng mới
                        @else
                            Đã xử lý
                        @endif -->
                        
                        <!-- <select class="dashboard-filter form-control select2" name="classNumber" id="classNumber" style="width: 100%;">
                            <option selected="selected" value="0" >Đơn mới</option>
                            <option value="1">Đã xử lý</option>
                        </select> -->

                    </td>
                    <!-- <td>{{$orde->order_status}}</td> -->
                    <td>
                        <a href="{{route('view_order', ['order_id'=>$orde->order_id])}}" style="color:#16a50b">
                            <i class="far fa-eye" title="View Order Detail"></i>
                        </a>
                        &nbsp;
                        <a href="{{route('view_order_invoice', ['order_id'=>$orde->order_id])}}" style="color:#0000a8">
                            <i class="fas fa-search-plus" title="View Invoice"></i>
                        </a>
                        &nbsp;
                        <a href="{{route('download_order_invoice', ['order_id'=>$orde->order_id])}}" style="color:#0000a8">
                            <i class="fas fa-arrow-circle-down" title="Download Invoice"></i>
                        </a>
                        &nbsp;
                        <a href="{{route('delete_order', ['order_id'=>$orde->order_id])}}" id="delete" style="color: red;"><i class="fas fa-trash-alt" title="click to destroy"></i></a>  
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        <form action="{{ route('order_import_csv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- <input type="file" name="file" class="form-control" accept=".xlsx">
            <br>
            <button class="btn btn-success" name="order_import_csv"><i class="fas fa-file-import"></i> Import Order Data</button> -->
            <a class="btn btn-warning" href="{{ route('order_export_csv') }}" name="order_export_csv"><i class="fas fa-file-export"></i> Export Order Data</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>

@endsection
