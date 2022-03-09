<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Dish;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;
session_start();

class cartController extends Controller
{
    public function insert(Request $request){
        $dish = Dish::where('dish_id', $request->dish_id)->first();
        Cart::add([
            'id' => $request->dish_id,
            'qty' => $request->qty,
            'name' => $dish->dish_name,
            'price' => $dish->full_price,
            'weight' => 550,
            'options' => 
            [
                'half_price' => $dish->half_price,
                'image' => $dish->dish_image,
            ],
        ]);
      
        return redirect()->route("show_cart");
    }
    public function show(){
        $CartDish = Cart::content();
        $city = City::orderby('matp','ASC')->get();
        $categories = Category::where('category_status', 1)->get();
        return view('FrontEnd.cart.show_cart', compact('CartDish', 'categories', 'city'));
    }
    public function remove($rowId){
        Cart::remove($rowId);
        Session::forget('coupon');
        return back()->with('message', 'Remove Item Success!');
    }
    public function update(Request $request){
        Cart::update($request->rowId, $request->qty);
        return back()->with('message', 'update Item Success!');
    }

    public function CheckCoupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $count_session = Session::get('coupon');
                if($count_session == true){
                    $is_avaliable = 0;
                    if($is_avaliable == 0){
                        $coup[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_type' => $coupon->coupon_type,
                            'coupon_value' => $coupon->coupon_value,
                        );
                        Session::put('coupon', $coup);
                    }
                }else{
                    $coup[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_type' => $coupon->coupon_type,
                        'coupon_value' => $coupon->coupon_value,
                    );
                    Session::put('coupon', $coup);
                } 
                Session::save();
                return redirect()->back()->with('message', 'Add discount code successfully');
            }
        }else{
            return redirect()->back()->with('error', 'Add wrong discount code, Please try again! ');
        }
        
        // return back()->with('message', 'update Item Success!');
    }
}
