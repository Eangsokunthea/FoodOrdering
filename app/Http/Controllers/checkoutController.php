<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Cart;
// use Illuminate\Support\Facades\Session;
use Session;

class checkoutController extends Controller
{
    public function payment(){
        $categories = Category::where('category_status', 1)->get();
        return view('FrontEnd.checkout.checkout_payment', compact('categories'));
    }
    public function newOrder(Request $request){

        $paymentType = $request->payment_type;

        if($paymentType == 'Cash'){
            $order = new Order();
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = Session::get('shipping_id');
            $order->order_total = Session::get('sum');
            $order->save();

            $payMent = new Payment();
            $payMent->order_id = $order->order_id;
            $payMent->payment_type = $paymentType;
            $payMent->save();

            $CartDish = Cart::content();
            foreach($CartDish as $cart)
            {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->order_id;
                $orderDetail->dish_id = $cart->id;
                $orderDetail->dish_name = $cart->name;
                if($cart->half_price == null){
                    $orderDetail->dish_price = $cart->price;
                }
                elseif($cart->half_price !== null){
                    $orderDetail->dish_price = $cart->price;
                    $orderDetail->dish_price = $cart->half_price;
                }
                $orderDetail->dish_qty = $cart->qty;
                $orderDetail->save();
            }
            
            Cart::destroy();
            
            // Session::flash('success', 'Your order has been successfully processed...!');

            return redirect('/checkout/order/complete')->with('message','Your order has been successfully processed...!');;
        }
        elseif($paymentType == 'Stripe'){
            $order = new Order();
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = Session::get('shipping_id');
            $order->order_total = Session::get('sum');
            $order->save();

            $payMent = new Payment();
            $payMent->order_id = $order->order_id;
            $payMent->payment_type = $paymentType;
            $payMent->save();

            $CartDish = Cart::content();
            foreach($CartDish as $cart)
            {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->order_id;
                $orderDetail->dish_id = $cart->id;
                $orderDetail->dish_name = $cart->name;
                if($cart->half_price == null){
                    $orderDetail->dish_price = $cart->price;
                }
                elseif($cart->half_price !== null){
                    $orderDetail->dish_price = $cart->price;
                    $orderDetail->dish_price = $cart->half_price;
                }
                $orderDetail->dish_qty = $cart->qty;
                $orderDetail->save();
            }
            
            Cart::destroy();
            // dd('Success');
            return redirect('/stripe-payment');

        }
    
    }

    public function complete(){
        $categories = Category::where('category_status', 1)->get();
        return view('FrontEnd.checkout.order_complete', compact('categories'));
    }
}
