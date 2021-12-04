<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class couponController extends Controller
{
    public function index(){
        return view('BackEnd.coupon.addCoupon');
    }
    public function save_boy(Request $request){
        $coupon = new Coupon();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->coupon_value = $request->coupon_value;
        $coupon->coupon_min_value = $request->coupon_min_value;
        $coupon->expired_on = $request->expired_on;
        $coupon->added_on = $request->added_on;
        $coupon->coupon_status = $request->coupon_status;
        $coupon->save();

        return back()->with('message','Coupon Saved');
    }
    public function  manage(){
        $coupons = Coupon::all();
        return view('BackEnd.coupon.manageCoupon', compact('coupons'));
    }
    public function active($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->coupon_status = 1;
        $coupon->save();
        return back();
    }
    public function inactive($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->coupon_status = 0;
        $coupon->save();
        return back();
    }
    public function delete($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        return back();
    }   
    public function update(Request $request){
        $coupon = Coupon::find($request->coupon_id);
        $coupon->coupon_name = $request->coupon_name;   
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->coupon_value = $request->coupon_value;
        $coupon->coupon_min_value = $request->coupon_min_value;
  
        $coupon->save();
        return redirect('/coupon/manage')->with('message', 'coupon Updated');
    }
    
    public function UpsetCoupon(){
        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
            return redirect()->back()->with('message', 'Delete discount code successfully!');
        }
    }
 
}
