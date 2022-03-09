<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Feeship;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\Wards;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cart;

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
        $CartDish = Cart::content();
        $categories = Category::where('category_status', 1)->get();
        $city = City::orderby('matp','ASC')->get();
        $customer = Customer::find(Session::get('customer_id'));
        
        return view('FrontEnd.checkout.shipping', compact('customer', 'categories', 'CartDish', 'city'));
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

    public function SelectDeliverHome(Request $request){
        $data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}

    		}else{

    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn xã phường---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}

    }

    public function CalculateFee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                    foreach($feeship as $key => $fee){
                    Session::put('fee',$fee->fee_feeship);
                    Session::save();
                }
                }else{ 
                    Session::put('fee',1);
                    Session::save();
                }
            }

        }
    }

    public function DelFee(){
        Session::forget('fee');
        return redirect()->back();
    }

    
}
