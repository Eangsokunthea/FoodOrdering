@extends('BackEnd.master')
@section('title')
    Delivery Add
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
                        Delivery 
                    </div>
                    <div class="card-body">
                        <form action="{{route('delivery_save')}}" method="POST" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="">Delivery Name</label>
                                <input type="text" class="form-control" name="delivery_name">
                            </div>
                            <div class="form-group">
                                <label for="">Delivery Phone Number</label>
                                <input type="text" class="form-control" name="delivery_phone_number">
                            </div>
                            <div class="form-group">
                                <label for="">Delivery Password</label>
                                <input type="password" class="form-control" name="delivery_password">
                            </div>
                            <div class="form-group">
                                <label for="">Added On</label>
                                <input type="date" class="form-control" name="added_on">
                            </div>
                            <div class="form-group">
                                <label for="">Delivery Status</label>
                                <div class="radio">
                                    <input type="radio" name="delivery_status" value="1">Active
                                    <input type="radio" name="delivery_status" value="0">Inactive
                                </div>
                            </div>
                            <button type="submit" name="tbn" class="btn btn-outline-primary btn-block">Delivery Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>    


@endsection