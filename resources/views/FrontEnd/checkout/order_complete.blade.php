@extends('FrontEnd.master')
@section('title')
    Order | Complete
@endsection

@section('content')
    <div class="products">
        <div class="container">
            <div class="col-md-9 product-w3ls-right">
                <div class="card">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>{{session()->get('message')}}</strong>
                        </div>
                    @endif                                                                                                                                                                        
                    <div class="card-body">
                       
                        <h2 class="text-capitalize">Thanks for your order.</h2>
                        <p>We will contact you soon...</p>
                    </div>
                    <div class="card-header">
                        <h1 class="text-center text-muted">Hóa đơn của bạn</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-responsive">
                            
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Full Price</th>
                                    <th scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @php($sum=0)
                                @foreach($CartDish as $Cdish)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$Cdish->name}}</td>
                                    <td>{{$Cdish->qty}}</td>
                                    <td>{{$Cdish->price}} $</td>
                                    <td>{{$subTotal = $Cdish->price*$Cdish->qty}} $</td>
                                    {{$Cdish->subTotal}}
                                    <input type="hidden" value="{{$sum = $sum + $subTotal}}">
                                
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="4">
                                        <h3>Your Information Order</h3>
                                    </td>
                                    <td >
                                        Total Price = {{$sum}} $<br>
                                        <?php
                                            Session::put('sum', $sum);
                                        ?>
                                        @if(Session::get('coupon'))
                                            @foreach(Session::get('coupon') as $coup)
                                                @if($coup['coupon_type']==1)
                                                    Discount : {{$coup['coupon_value']}}.%
                                                    <p>
                                                        <?php
                                                            $total_coupon = ($sum * $coup['coupon_value'])/100;
                                                            Session::put('total_coupon', $total_coupon);
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                            $total_after_coupon = $sum-$total_coupon;
                                                            Session::put('total_after_coupon', $total_after_coupon);
                                                        ?> 
                                                    </p>

                                                @elseif($coup['coupon_type']==0)
                                                    Discount : {{number_format($coup['coupon_value'],0,',','.')}}.$
                                                    <p>
                                                        <?php
                                                            $total_coupon = $sum - $coup['coupon_value'];
                                                            Session::put('total_coupon', $total_coupon);
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                            $total_after_coupon = $total_coupon;
                                                            Session::put('total_after_coupon', $total_after_coupon);
                                                        ?> 
                                                    </p>
                                                @endif
                                            @endforeach
                                        @endif


                                        @if(Session::get('fee'))
                                            <a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
                                            Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}.$</span>
                                            <?php 
                                                $total_after_fee = $sum + Session::get('fee'); 
                                                Session::put('total_after_fee', $total_after_fee);
                                            ?>
                                        @endif 
                                        
                                        <br>

                                        Total remaning:
                                            <?php 
                                                if(Session::get('fee') && !Session::get('coupon')){
                                                    $total_after = $total_after_fee;
                                                    echo number_format($total_after,0,',','.').'$';
                                                }elseif(!Session::get('fee') && Session::get('coupon')){
                                                    $total_after = $total_after_coupon;
                                                    echo number_format($total_after,0,',','.').'$';
                                                }elseif(Session::get('fee') && Session::get('coupon')){
                                                    $total_after = $total_after_coupon;
                                                    $total_after = $total_after + Session::get('fee');
                                                    echo number_format($total_after,0,',','.').'$';
                                                }elseif(!Session::get('fee') && !Session::get('coupon')){
                                                    $total_after = $sum;
                                                    echo number_format($total_after,0,',','.').'$';
                                                }

                                            ?>
                                    </td>

                                </tr>
                            </tbody>
                            
                        </table>
                     
                    </div>

                    <p>
                        <a href="{{URL::to('/TroVe-muasam')}}" class="btn btn-primary btn-outline mt-3">Back Home</a>
                        <a href="{{URL::to('/all-dish')}}" class="btn btn-danger btn-outline mt-3">Continue shopping</a>

                    </p>                                     
                  
                </div> 
                               
            </div>
        </div>
    </div>
@endsection