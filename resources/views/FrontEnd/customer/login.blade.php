@extends('FrontEnd.master')
@section('title')
    Login Customer
@endsection

@section('content')
<!-- sign in-page -->
<div class="login-page about">
    <img class="login-w3img" src="{{asset('/')}}frontEnd/images/img3.jpg" alt="">
    <div class="container"> 
        <h3 class="w3ls-title w3ls-title1">Sign In to your account</h3>   
        <div class="login-agileinfo"> 
            @if(session()->has('message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{session()->get('message')}}</strong>
                </div>
            @endif
            <form action="{{route('store_customer_login')}}" method="post"> 
                @csrf
                <input class="agile-ltext" type="email" name="email" placeholder="Your Email" required="">
                <input class="agile-ltext" type="password" name="password" placeholder="Password" required="">
                
                <input type="submit" value="Sign In">
            </form>
            <!-- <p>Already have an account?  <a href="login.html"> Login Now!</a></p>  -->
        </div>	 
    </div>
</div>
<!-- //sign in-page --> 
@endsection