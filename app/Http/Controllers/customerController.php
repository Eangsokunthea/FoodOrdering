<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Shipping;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Session;

class customerController extends Controller
{
    public function register(){
        $categories = Category::where('category_status', 1)->get();
        return view('FrontEnd.customer.register', compact('categories'));
    }
    public function store_register(Request $request){
        $customer = new Customer();
        $customer->name = $request->name; 
        $customer->email = $request->email; 
        $customer->phone_no = $request->phone_no; 
        $customer->password = bcrypt($request->password); 
        $customer->save();

        $customer_id = $customer->customer_id;
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $customer->name);

        // $data = $customer->toArray();

        // Mail::send('FrontEnd.mail.welcome_mail', $data, function($message) use($data){
        //     $message->to($data['email']);
        //     $message->subject('Welcome To Staple Food');
        // });
        // dd('success');
        return redirect('/shipping');
    }
    public function login(){
        $categories = Category::where('category_status', 1)->get();
        return view('FrontEnd.customer.login', compact('categories'));
    }
    public function store_login(Request $request){
        $customer = Customer::where('email', $request->email)->first();
        if(password_verify($request->password, $customer->password))
        {
            Session::put('customer_id', $customer->customer_id);
            Session::put('customer_name', $customer->name);
            return redirect('/shipping');
        }
        else
        {
            return redirect('/login/customer')->with('message', 'Your password is Incorrect, Please provide us your correct password.');

        }
        // return view('FrontEnd.customer.register', compact('categories'));
    }
    public function logout(){
        Session::forget('customer_id');
        Session::forget('customer_name');

        return redirect('/');
    }

    public function shipping(){
        $categories = Category::where('category_status', 1)->get();
        $customer = Customer::find(Session::get('customer_id'));
        
        return view('FrontEnd.checkout.shipping', compact('customer', 'categories'));
    }
    
    public function storeShipping(Request $request){
        $shipping = new Shipping();
        $shipping->name = $request->name; 
        $shipping->email = $request->email; 
        $shipping->phone_no = $request->phone_no; 
        $shipping->address = $request->address; 
        $shipping->save();

        Session::put('shipping_id', $shipping->id );

        return redirect()->route('checkout_payment');

    }

}
