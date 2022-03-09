@extends('BackEnd.master')
@section('title')
    Order Detail
@endsection

@section('content')

<div class="offset-2 col-md-8">
    <div class="card my-5">                                                           
        <div class="card-header">
            <h1 class="text-center text-muted">Customer Into For Order</h1>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">    
                <tr>
                    <th>Name</th>
                    <td>{{$customer->name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$customer->email}}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{$customer->phone_no}}</td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
   
    <div class="card my-5">                                                           
        <div class="card-header">
            <h1 class="text-center text-muted">Order Details Into For Order</h1>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">    
                <tr>
                    <th>Order No</th>
                    <td>{{$order->order_id}}</td>
                </tr>
                <tr>
                    <th>Order Total</th>
                    <td>{{$order->order_total}}.00$</td>
                </tr>
                <tr>
                    <th>Order Status</th>
                    <td>{{$order->order_status}}</td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card my-5">                                                           
        <div class="card-header">
            <h1 class="text-center text-muted">Shipping Into For Order</h1>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">    
                <tr>
                    <th>Name</th>
                    <td>{{$shipping->name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$shipping->email}}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{$shipping->phone_no}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{$shipping->address}}</td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card my-5">                                                           
        <div class="card-header">
            <h1 class="text-center text-muted">Payment Into For Order</h1>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">    
                <tr>
                    <th>Payment Type</th>
                    <td>{{$payment->payment_type}}</td>
                </tr>
                <tr>
                    <th>Payment Status</th>
                    <td>{{$payment->payment_status}}</td>
                </tr>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card my-5">                                                           
        <div class="card-header">
            <h1 class="text-center text-muted">Dish Details Into For Order</h1>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Full Price</th>
                        <th>Total Price</th>
                     
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @php($sum = 0)
                    @foreach($order_details as $orderD)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$orderD->dish_id}}</td>
                        <td>{{$orderD->dish_name}}</td>
                        <td>{{$orderD->dish_qty}}</td>
                        <td>{{$orderD->dish_price}}.00$</td>
                        <td>{{$total = $orderD->dish_price * $orderD->dish_qty}}.00$</td>
                       
                    </tr>
                    @php($sum = $sum + $total)
                    @endforeach
                   
                </tbody>
                
            </table>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                </div>
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Sub Total</strong>
                                </td>
                                <td class="right">{{$sum}}.00$</td>
                            </tr>

                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Discount</strong>
                                </td>
                                <td class="right">
                                    @if(Session::get('coupon'))
                                        @foreach(Session::get('coupon') as $coup)
                                            @if($coup['coupon_type']==1)
                                                {{$coup['coupon_value']}}%
                                            @elseif($coup['coupon_type']==0)
                                                {{number_format($coup['coupon_value'],0,',','.')}}$
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">FeeShip</strong>
                                </td>
                                <td class="right">{{Session::get('fee')}}.00$</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Total Remaining</strong> </td>
                                <td class="right">
                                    <strong class="text-dark">{{$order->order_total}}$</strong>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
   
</div>
@endsection