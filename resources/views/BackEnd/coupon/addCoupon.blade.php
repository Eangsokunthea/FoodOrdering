@extends('BackEnd.master')
@section('title')
    Coupon Add
@endsection


@section('content')
    <div class="container">
        
        <div class="row">
            <div class="offset-3 col-md-5 my-lg-5">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{{session()->get('message')}}</strong>
                    </div>
                @endif 
                <div class="card">
                    <div class="card-header text-center">
                        Coupon
                    </div>
                    <div class="card-body">
                        <form action="{{route('coupon_save')}}" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="">Coupon Name</label>
                                <input type="text" class="form-control" name="coupon_name">
                            </div>
                            <div class="form-group">
                                <label for="">Coupon Code</label>
                                <input type="text" class="form-control" name="coupon_code">
                            </div>
                            <div class="form-group">
                                <label for="">Coupon Value</label>
                                <input type="text" class="form-control" name="coupon_value">
                            </div>
                            <div class="form-group">
                                <label for="">Cart Min Value</label>
                                <input type="text" class="form-control" name="coupon_min_value">
                            </div>
                            <div class="form-group">
                                <label for="">Expired Date</label>
                                <input type="date" class="form-control" name="expired_on">
                            </div>
                            <div class="form-group">
                                <label for="">Added On</label>
                                <input type="date" class="form-control" name="added_on">
                            </div>
                            <div class="form-group">
                                <label for="">Select Coupon Type</label>
                                <div class="radio">
                                    <input type="radio" name="coupon_type" value="1">Percentage
                                    <input type="radio" name="coupon_type" value="0">fixed
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Coupon Status</label>
                                <div class="radio">
                                    <input type="radio" name="coupon_status" value="1">Active
                                    <input type="radio" name="coupon_status" value="0">Inactive
                                </div>
                            </div>
                            <button type="submit" name="tbn" class="btn btn-outline-primary btn-block">Coupon Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>    


@endsection