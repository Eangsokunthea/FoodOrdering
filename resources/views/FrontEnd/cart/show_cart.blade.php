
@extends('FrontEnd.master')
@section('title')
    Cart Show Item
@endsection

@section('content')
<div class="products">
    <div class="container">
        <div class="col-md-9 product-w3ls-right">
            <div class="card"> 
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{session()->get('message')}}
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                        {{session()->get('error')}}
                    </div>
                @endif
                <h3 class="card-header text-center mt-3" style="background-color: lightyellow; height: 50px; width: auto;">
                    Cart Items
                </h3>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Remove</th>
                                <th scope="col" class="text-success">Dish Name</th>
                                <th scope="col">Dish Image</th>
                                <th scope="col">Dish Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @php($sum=0)
                            @foreach($CartDish as $Cdish)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <th scope="row">
                                    <a href="{{route('remove_cart', ['rowId' => $Cdish->rowId])}}" type="button" class="btn btn-danger">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </th>
                                <td>{{$Cdish->name}}</td>
                                <td><img src="{{asset($Cdish->options->image)}}" style="height: 50px; width: 50px; border-radius: 50%" alt=""></td>    
                                @if($Cdish->options->half_price == null)
                                    <td>{{$Cdish->price}} $</td>
                                    
                                @else
                                    <td>{{$Cdish->options->half_price}} $</td>
                                   
                                @endif
    
                                <td>
                                    <form action="{{route('update_cart')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="rowId" value="{{$Cdish->rowId}}">
                                        <input type="number" name="qty" value="{{$Cdish->qty}}" min="1" style="width: 50px; height: 25px;">
                                        <input type="submit" class="btn btn-success" name="btn" value="Update" style="padding-top: 2px; padding-bottom: 2px;" >
                                    </form>
                                </td>
    
                                @if($Cdish->options->half_price == null)
                                 <td>{{$subTotal = $Cdish->price*$Cdish->qty}} $</td>
                                @else
                                    <td>{{$subTotal = $Cdish->options->half_price*$Cdish->qty}} $</td>
                                @endif
                                {{$Cdish->subTotal}}
                                <input type="hidden" value="{{$sum = $sum + $subTotal}}">
                                
                            </tr>
                            @endforeach
                           
                            <tr>
                                <td colspan="6">
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

                                <td>
                                    @if(Session::get('coupon'))
                                        <a href="{{route('upset_coupon')}}" class="btn btn-danger check_out">Delete Discount Code</a>
                                    @endif
    
                                    @if(Session::get('customer_id'))
                                        <a href="{{url('/checkout/payment')}}" class="btn btn-info">
                                            <i class="fa fa-shopping-bag"></i>
                                            Checkout
                                        </a>
                                    @else
                                        <a class="btn btn-info" data-toggle="modal" data-target="#Login_or_Register">
                                            <i class="fa fa-shopping-bag"></i>
                                            Checkout
                                        </a>
                                    @endif

                                    
										
                                </td>
                            </tr>
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      
        <div class="col-md-9 product-w3ls-right">
            <div class="login-agileinfo">
                <form>
                    @csrf 
                    <div class="form-group">
                        <label for="exampleInputPassword1">Chọn thành phố</label>
                        <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                        
                                <option value="">--Chọn tỉnh thành phố--</option>
                            @foreach($city as $key => $ci)
                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                            @endforeach
                                
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Chọn quận huyện</label>
                        <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                <option value="">--Chọn quận huyện--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Chọn xã phường</label>
                        <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                <option value="">--Chọn xã phường--</option>   
                        </select>
                    </div>
                    
                    <!-- <button type="button" name="add_delivery" class="btn btn-info add_delivery">Txhêm phí vận chuyển</button> -->
                    <input type="button" value="Calculate Transport" name="calculate_order" class="btn btn-info calculate_delivery">
                </form>
            
            </div>
            
        </div>

        <div class="col-md-9 product-w3ls-right">      
            <form action="{{route('check_coupon')}}" method="post" class="login-agileinfo">
                @csrf
                <h5 class="text-center">Input your discount code</h5>
                <input class="agile-ltext" type="text" name="coupon" placeholder="Input your discount code...">
                <input type="submit" class="btn btn-default check_coupon" style="float:right;" name="check_coupon" value="Check">
            </form>
        </div>
            
        
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="Login_or_Register" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>
                                Welcome..! To Staple Food
                            </h3>
                            <div class="text-center" 
                                style="
                                    margin-top: 25px;
                                    height: 168px;
                                    width:160px;
                                    border-radius:50%;
                                    background-color: darkblue;
                                    color: ghostwhite;
                                    padding-top:65px;
                                    font-size:20px;        
                                    ">
                                Keep your smile...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Are you a new member..!</h4>
                            <a href="{{route('sign_up')}}" class="btn-block btn-primary text-center" 
                                style="
                                    height:60px;
                                    width:auto;
                                    padding-top:12px;
                                    margin-top:25px;
                                    font-size:25px;                                                                                    
                                    ">
                                <span class="mt-5">Register</span>                                                        
                            </a>
                            <h3 class="mt-lg-5 text-center">Or</h3>
                            <h4 class="mt-5">Already have an account...</h4>
                            <a href="{{route('sign_in')}}" class="btn-block btn-success text-center" 
                                style="
                                    height:60px;
                                    width:auto;
                                    padding-top:12px;
                                    margin-top:10px;
                                    font-size:25px;   
                                    ">

                                <span class="mt-5">Login</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="login-page about">
                    <div class="cotainer">
                        <h3 class="w3ls-title w3ls-title1">Sign up to your account</h3>
                        <div class="login-agileinfo">
                            <form action="" method="post">
                                <input type="text" class="agile-ltext" name="Username" placeholder="Username" require="">
                                <input type="text" class="agile-ltext" name="email" placeholder="Your Email" require="">
                                <input type="text" class="agile-ltext" name="phone" placeholder="Your Phone" require="">
                                <input type="text" class="agile-ltext" name="password" placeholder="Your Password" require="">
                                <input type="text" class="agile-ltext" name="confirm password" placeholder="Confirm Password" require="">

                                <div class="wthreelogin-text">
                                    <ul>
                                        <li>
                                            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>
                                                <span>I agree to the terms of sevice</span>
                                            </label>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <input type="submit" value="Sign Up"> 
                            </form>
                            <p>Already have an account? <a href="login.html">Login Now!</a></p>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button> -->
            </div>
            </div>
        </div>
    </div>

@endsection