@extends('BackEnd.master')
@section('title')
    FeeShip Delivery Manage
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
        <h3 class="card-title">FeeShip Delivery Manage</h3>    
    </div>
    <!-- /.card-header -->
    
    <div class="card-body">
        <form>
            @csrf 
            <div class="form-group">
                <label for="exampleInputPassword1">Chọn người vận chuyển</label>
                <select name="delivery" id="delivery" class="form-control input-sm m-bot15 delivery">
                        <option value="">--Chọn người vận chuyển--</option>
                    @foreach($boy_delivery as $key => $boy)
                        <option value="{{$boy->delivery_id }}">{{$boy->delivery_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Chọn thành phố</label>
                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                
                        <option value="">--Chọn tỉnh thành phố--</option>
                    @foreach($city as $key => $ci)
                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                    @endforeach
                        
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Chọn quận huyện</label>
                <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                        <option value="">--Chọn quận huyện--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Chọn xã phường</label>
                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                        <option value="">--Chọn xã phường--</option>   
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phí vận chuyển</label>
                <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Fee Ship">
            </div>
        
            <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
        </form>
        <div id="load_delivery">
            
        </div>
      
    </div>
    
    <!-- /.card-body -->
</div>
@endsection