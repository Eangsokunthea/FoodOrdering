@extends('BackEnd.master')
@section('title')
    Delivery Manage
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
        <h3 class="card-title">Delivery Manage</h3>    
    </div>
    <!-- /.card-header -->
    
    
    <div class="card-body">
        <!-- @foreach($boy_delivery as $boys)
        <a data-toggle="modal" data-target="#add{{$boys->delivery_id}}" class="btn btn-success mb-2" style="color: #ffffff;">Add Delivery</a>
        @endforeach -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($boy_delivery as $boy)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$boy->delivery_name}}</td>
                    <td>{{$boy->delivery_phone_number}}</td>
                    <td>
                        @if($boy->delivery_status == 1) 
                            <a href="{{route('inactive_delivery', ['delivery_id'=>$boy->delivery_id])}}" style="color: blue;" title="click to Active">Active</a>
                        @else
                            <a href="{{route('active_delivery', ['delivery_id'=>$boy->delivery_id])}}" style="color: red;" title="click to Inactive">Inactive</a>
                        @endif
                    </td>
                    <td>{{$boy->added_on}}</td>
                    <td>    
                        <a data-toggle="modal" data-target="#edit{{$boy->delivery_id}}" class="active" style="color: blue;" ><i class="fas fa-pencil-alt" title="click to change it"></i></a>&nbsp;&nbsp;   
                        <a href="{{route('delete_delivery', ['delivery_id'=>$boy->delivery_id])}}" id="delete" style="color: red;"><i class="fas fa-trash-alt" title="click to destroy"></i></a>             
                        
                    </td>
                </tr>

                <!--start modal update -->
                <div class="modal fade" id="edit{{$boy->delivery_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('update_delivery')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Name</label>
                                        <input type="text" class="form-control" name="delivery_name" value="{{$boy->delivery_name}}">
                                        <input type="hidden" class="form-control" name="delivery_id"  value="{{$boy->delivery_id}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="delivery_phone_number" value="{{$boy->delivery_phone_number}}">
                                        <input type="hidden" class="form-control" name="delivery_id"  value="{{$boy->delivery_id}}">
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
        
      
    </div>
    
    <!-- /.card-body -->
</div>
@endsection