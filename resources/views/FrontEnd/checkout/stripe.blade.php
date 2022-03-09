@extends('FrontEnd.master')
@section('title')
    Stripe | Payment
@endsection

@section('content')
    <div class="products">
      
    <div class="container">
            <div class="col-md-9 product-w3ls-right">
                <div class="card">
                    <h1 class="card-title">Thanks For Purchasing With Us..!</h1>
                    <div class="card-body">
                        <hr>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-truncate" style="font-size: 28px;">Your order has been placed</div>
                                <div class="card-body">
                                    <strong class="text-bold" style="font-size:20px;">
                                        Your payable amount is
                                        @if(Session::get('sum') == null) 
                                            0.00$ and payable amount is {{Session::get('')}} 0.00$
                                        @else
                                            <?php
                                                if(Session::get('fee') && !Session::get('coupon')){
                                                    $total_after = Session::get('total_after_fee');
                                                    echo number_format($total_after,0,',','.').'.00$';
                                                }elseif(!Session::get('fee') && Session::get('coupon')){
                                                    $total_after = Session::get('total_after_coupon');
                                                    echo number_format($total_after,0,',','.').'.00$';
                                                }elseif(Session::get('fee') && Session::get('coupon')){
                                                    $total_after = Session::get('total_after_coupon');
                                                    $total_after = $total_after + Session::get('fee');
                                                    echo number_format($total_after,0,',','.').'.00$';
                                                }elseif(!Session::get('fee') && !Session::get('coupon')){
                                                    $total_after = Session::get('sum');
                                                    echo number_format($total_after,0,',','.').'.00$';
                                                }
                                            ?>
                                        @endif   
                                        
                                    </strong>
                                    <br>
                                    <strong style="font-size:20px;">Please make payment by entering your Credit or Debit cart.</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color:whitesmoke">
                            <div class="card">
                                <div class="card-body">
                                    <script src="https://js.stripe.com/v3/"></script>     
                                    <div class="card-header text-capitalize text-truncate" style="font-size: 28px;">Enter Your Cart Info Carfully</div>
                                    <form role="form" action="{{route('stripe.payment')}}" method="post" 
                                        data-cc-on-file="false" id="payment-form"
                                        data-stripe-publishable-key="{{env('pk_test_51K02XyKnyjf6hJLtC7JVgsJ8fXyAry8U3IoEtwaDRhRYPsiu6IfwmkmnCdnDGX4lWe2mVKYDCUE4OwVluPw0wegU008efaL9mJ')}}">
                                        @csrf
                                        <div class="form-row">
                                            <label>Your Name</label>
                                            <input type="text" name="name" placeholder="Enter your name" class="form-control">

                                            <label>Your Amount</label>
                                            <input type="text" name="grandTotal" placeholder="Enter your amount" class="form-control">
                                            
                                            <label for="card-element">
                                                Credit or detit card
                                            </label>
                                            <div id="card-element">
                                                <!--Stripe.js injects the Payment Element-->
                                            </div>
                                            <!-- used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                        </div>
                                        <button class="btn btn-success mb-2" style="float: right; margin-top:8px; margin-bottom:8px">Submit Payment</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>                
            </div>
        </div>
    </div>
    {{Session::forget('sum')}}
    <script>
        // Create a Stripe client.
        // var stripe = Stripe(publishable_key);
        var stripe = Stripe('pk_test_51K02XyKnyjf6hJLtC7JVgsJ8fXyAry8U3IoEtwaDRhRYPsiu6IfwmkmnCdnDGX4lWe2mVKYDCUE4OwVluPw0wegU008efaL9mJ');
        
        // Create an instance of Elements.
        var elements = stripe.elements();
            
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
            
        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});
            
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
            
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
            
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
            
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            
            // Submit the form
            form.submit();
        }
    </script>
@endsection 