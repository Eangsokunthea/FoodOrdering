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
                </div>                
            </div>
        </div>
    </div>
@endsection