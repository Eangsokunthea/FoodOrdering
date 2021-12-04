@extends('BackEnd.master')
@section('title')
    Dish Manage
@endsection


@section('content')
<div class="card">
    @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{session()->get('message')}}</strong>
        </div>
    @endif                                                                      
    <div class="card-header">
    <h3 class="card-title">Dish Manage</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Category</th>
                <th>Detail</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php($i = 1)
            @foreach($dishes as $dish)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$dish->dish_name}}</td>
                <td>{{$dish->category_name}}</td>
                <td>{{$dish->dish_detail}}</td>
                <td>
                    <img src="{{asset($dish->dish_image)}}" height="25" width="60" class="img-fluid img-thumbnail">
                </td>
        
                <td>
                    @if($dish->dish_status == 1) 
                        <a href="{{route('inactive_dish', ['dish_id'=>$dish->dish_id])}}" style="color: blue;" title="click to Active">Active</a>
                    @else
                        <a href="{{route('active_dish', ['dish_id'=>$dish->dish_id])}}" style="color: red;" title="click to Inactive">Inactive</a>
                    @endif
                </td>

                <td>{{$dish->added_on}}</td>

                <td>    
                    <a data-toggle="modal" data-target="#edit{{$dish->dish_id}}" class="active" style="color: blue;" ><i class="fas fa-pencil-alt" title="click to change it"></i></a>&nbsp;&nbsp;   
                    <a href="{{route('delete_dish', ['dish_id'=>$dish->dish_id])}}" id="delete" style="color: red;"><i class="fas fa-trash-alt" title="click to destroy"></i></a>             
                    
                </td>
            </tr>

            <!--start modal -->
            <div class="modal fade" id="edit{{$dish->dish_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Dish</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('update_dish')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="dish_name" value="{{$dish->dish_name}}">
                                <input type="hidden" class="form-control" name="dish_id"  value="{{$dish->dish_id}}">
                            </div>
                            <div class="form-group">
                                <label>Previous Category</label>
                                <input type="text" class="form-control" value="{{$dish->category_name}}">

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
                                <textarea type="text" rows="5" name="dish_detail" class="form-control" >{{$dish->dish_detail}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Previous Image</label>
                                <img src="{{asset($dish->dish_image)}}" height="100px" width="100px" border-radius= "50%" >
                                <input type="file" class="form-control" name="dish_image" accept="image/*">
                            </div>
                            <div class="card">
                                <div class="card-header">Dish Attribute</div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Full Price</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="full_price" value="{{$dish->full_price}}">
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label>Half Price</label>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <input type="text" class="form-control" name="half_price" value="{{$dish->half_price}}">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-outline-primary btn-block" name="btn" value="Update">
                            </div>
                        </form>
                    </div>
                    
                    </div>
                </div>
                </div>
            <!-- end modal -->
            @endforeach
        </tbody>
        
    </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection