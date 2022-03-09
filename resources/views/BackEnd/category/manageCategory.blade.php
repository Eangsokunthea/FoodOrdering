@extends('BackEnd.master')
@section('title')
    Category Manage
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
    <h3 class="card-title">DataTable with default features</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Order Number</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($categories as $cate)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$cate->category_name}}</td>
                    <td>{{$cate->order_number}}</td>
                    <td>
                        @if($cate->category_status == 1) 
                            <a href="{{route('inactive_category', ['category_id'=>$cate->category_id])}}" style="color: blue;" title="click to Active">Active</a>
                        @else
                            <a href="{{route('active_category', ['category_id'=>$cate->category_id])}}" style="color: red;" title="click to Inactive">Inactive</a>
                        @endif
                    </td>
                    <td>{{$cate->added_on}}</td>
                    <td>    
                        <a data-toggle="modal" data-target="#edit{{$cate->category_id}}" class="active" style="color: blue;" ><i class="fas fa-pencil-alt" title="click to change it"></i></a>&nbsp;&nbsp;   
                        <a href="{{route('delete_category', ['category_id'=>$cate->category_id])}}" id="delete" style="color: red;"><i class="fas fa-trash-alt" title="click to destroy"></i></a>             
                        
                    </td>
                </tr>

                <!--start modal -->
                <div class="modal fade" id="edit{{$cate->category_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('update_category')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Category Name</label>
                                    <input type="text" class="form-control" name="category_name" value="{{$cate->category_name}}">
                                    <input type="hidden" class="form-control" name="category_id"  value="{{$cate->category_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Order Number</label>
                                    <input type="number" class="form-control" name="order_number" value="{{$cate->order_number}}">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" name="btn" value="Update">
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
        <form action="{{ route('category_import_csv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control" accept=".xlsx">
            <br>
            <button class="btn btn-success" name="category_import_csv"><i class="fas fa-file-import"></i> Import Category Data</button>
            <a class="btn btn-warning" href="{{ route('category_export_csv') }}" name="category_export_csv"><i class="fas fa-file-export"></i> Export Category Data</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection