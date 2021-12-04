@extends('FrontEnd.master')
@section('title')
    Checkout Payment
@endsection

@section('content')
<div class="products">
    <div class="container">
        <div class="col-md-9 product-w3ls-right">
            <div class="card">
                <!-- @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{{session()->get('message')}}</strong>
                    </div>
                @endif  -->
                <h3 class="card-header text-center mt-3" style="background-color: lightyellow; height: 50px; width: auto;">
                    Dear {{Session::get('customer_name')}}.
                </h3> 
                <h4 class="text-center">
                    We've to know which payment method you want.
                </h4>
                <div class="card mt-4">
                    <h5 class="card-header text-center text-muted">Please select your payment method</h5>
                    <div class="card-body">
                        <div class="checkout-left">
                            <div class="address_form_agile mt-sm-5 mt-4">
                                <form action="{{route('new_order')}}" method="post">
                                    @csrf
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Cash On Delivery</th>
                                            <td>
                                                <input type="radio" name="payment_type" value="Cash"> Cash
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Stripe Card</th>
                                            <td>
                                                <input type="radio" class="mr-5" name="payment_type" value="Stripe"> Stripe
                                            </td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>
                                                <input type="submit" name="btn" class="btn btn-success" value="Confirm Order">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection