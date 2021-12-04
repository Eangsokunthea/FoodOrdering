@extends('BackEnd.master')
@section('title')
    Dish Add
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
                        <b>Dish Add</b>
                    </div>
                    <div class="card-body">
                        <form action="{{route('dish_save')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="dish_name">
                            </div>
                            <div class="form-group">
                                <label >Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">-------Select Category-------</option>
                                    @foreach($categories as $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Detail</label>
                                <textarea type="text" rows="5" name="dish_detail" class="form-control" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="dish_image">
                            </div>
                            <div class="form-group">
                                <label for="">Added On</label>
                                <input type="date" class="form-control" name="added_on">
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <div class="radio">
                                    <input type="radio" name="dish_status" value="1">Active
                                    <input type="radio" name="dish_status" value="0">Inactive
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" title="you can skip this">Dish Attribute</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Full Price</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="full_price" placeholder="Enter price">
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label>Half Price</label>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <input type="text" class="form-control" name="half_price" placeholder="Enter 2nd price">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="tbn" class="btn btn-outline-primary btn-block">Dish Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>    


@endsection