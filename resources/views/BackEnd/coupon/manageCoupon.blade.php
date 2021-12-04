@extends('BackEnd.master')
@section('title')
    Coupon Manage
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
        <h3 class="card-title">Coupon Manage</h3>    
    </div>
    <!-- /.card-header -->
    
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Cart Min</th>
                    <th>Added On</th>
                    <th>Expired On</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($coupons as $coup)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$coup->coupon_name}}</td>
                    <td>{{$coup->coupon_code}}</td>
                    <td>
                        @if($coup->coupon_type == 1)
                            Percentage.%
                        @else   
                            Fixed.$
                        @endif       
                    </td>
                    <td>
                        @if($coup->coupon_type == 1)
                            Discount {{$coup->coupon_value}}%
                        @else
                            Discount {{$coup->coupon_value}}$
                        @endif
                    </td>
                    <td>
                        {{$coup->coupon_min_value}}     
                    </td>
                    <td>{{$coup->added_on}}</td>
                    <td>{{$coup->expired_on}}</td>
                    <td>
                        @if($coup->coupon_status == 1) 
                            <a href="{{route('inactive_coupon', ['coupon_id'=>$coup->coupon_id])}}" style="color: blue;" title="click to Active">Active</a>
                        @else
                            <a href="{{route('active_coupon', ['coupon_id'=>$coup->coupon_id])}}" style="color: red;" title="click to Inactive">Inactive</a>
                        @endif
                    </td>
                    
                    <td>    
                        <a data-toggle="modal" data-target="#edit{{$coup->coupon_id}}" class="active" style="color: blue;" ><i class="fas fa-pencil-alt" title="click to change it"></i></a>&nbsp;&nbsp;   
                        <a href="{{route('delete_coupon', ['coupon_id'=>$coup->coupon_id])}}" id="delete" style="color: red;"><i class="fas fa-trash-alt" title="click to destroy"></i></a>             
                        
                    </td>
                </tr>

                <!--start modal update -->
                <div class="modal fade" id="edit{{$coup->coupon_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Coupon</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('update_coupon')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="coupon_name" value="{{$coup->coupon_name}}">
                                    <input type="hidden" class="form-control" name="coupon_id"  value="{{$coup->coupon_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Code</label>
                                    <input type="text" class="form-control" name="coupon_code" value="{{$coup->coupon_code}}">
                                    <input type="hidden" class="form-control" name="coupon_id"  value="{{$coup->coupon_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Coupon Value</label>
                                    <input type="text" class="form-control" name="coupon_value" value="{{$coup->coupon_value}}">
                                    <input type="hidden" class="form-control" name="coupon_id"  value="{{$coup->coupon_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Cart Min Value</label>
                                    <input type="text" class="form-control" name="coupon_min_value" value="{{$coup->coupon_min_value}}">
                                    <input type="hidden" class="form-control" name="coupon_id"  value="{{$coup->coupon_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Select Coupon Type</label>
                                    <div class="radio">
                                        <input type="radio" name="coupon_type" value="1">Percentage
                                        <input type="radio" name="coupon_type" value="0">fixed
                                        <input type="hidden" class="form-control" name="coupon_id"  value="{{$coup->coupon_id}}">
                                    </div>
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