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
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Order Total</th>
                    <th>Order Status</th>
                    <th>Order Date</th>
                    <th>Payment Type</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($orders as $order)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->order_total}}.00$</td>
                    <td>{{$order->order_status}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->payment_type}}</td>
                    <td>{{$order->payment_status}}</td>
                    
                    <td>
                        <a href="{{route('view_order', ['order_id'=>$order->order_id])}}" style="color:#16a50b">
                            <i class="far fa-eye" title="View Order Detail"></i>
                        </a>
                        &nbsp;
                        <a href="{{route('view_order_invoice', ['order_id'=>$order->order_id])}}" style="color:#0000a8">
                            <i class="fas fa-search-plus" title="View Invoice"></i>
                        </a>
                        &nbsp;
                        <a href="{{route('download_order_invoice', ['order_id'=>$order->order_id])}}" style="color:#0000a8">
                            <i class="fas fa-arrow-circle-down" title="Download Invoice"></i>
                        </a>
                        &nbsp;
                        <a href="{{route('delete_order', ['order_id'=>$order->order_id])}}" id="delete" style="color: red;"><i class="fas fa-trash-alt" title="click to destroy"></i></a>  
                    </td>

                                
                </tr>

                
                @endforeach
            </tbody>
            
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection