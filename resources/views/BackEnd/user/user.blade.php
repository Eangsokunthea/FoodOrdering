@extends('BackEnd.master')
@section('title')
    Customer Page
@endsection

@section('content')
<div class="card-body">
        <h4>All Users</h4>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($users as $user)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->password}}</td>
                </tr> 
                @endforeach  
            </tbody>
            
        </table>
    </div>
@endsection