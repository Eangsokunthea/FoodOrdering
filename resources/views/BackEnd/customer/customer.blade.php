@extends('BackEnd.master')
@section('title')
    Customer Page
@endsection

@section('content')
<div class="card-body">
        <h4>All Customers</h4>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($customers as $cus)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$cus->name}}</td>
                    <td>{{$cus->email}}</td>
                    <td>{{$cus->phone_no}}</td>
                    <td>{{$cus->password}}</td>
                    <td>    
                        <a href="{{route('delete_customer', ['customer_id'=>$cus->customer_id])}}" id="delete" style="color: red;"><i class="fas fa-trash-alt" title="click to destroy"></i></a>             
                    </td>
                </tr> 
                @endforeach  
            </tbody>
            
        </table>
    </div>
@endsection