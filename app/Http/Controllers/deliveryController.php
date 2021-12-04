<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class deliveryController extends Controller
{
    public function index(){
        return view('BackEnd.delivery.addDelivery');
    }
    public function save_boy(Request $request){
        $boy = new Delivery();
        $boy->delivery_name = $request->delivery_name;
        $boy->delivery_phone_number = $request->delivery_phone_number;
        $boy->delivery_password = $request->delivery_password;
        $boy->added_on = $request->added_on;
        $boy->delivery_status = $request->delivery_status;
        $boy->save();

        return back()->with('message','Delivery Saved');
    }
    public function  manage(){
        $boy_delivery = Delivery::all();
        $city = City::orderby('matp','ASC')->get();

        return view('BackEnd.delivery.manageDelivery', compact('boy_delivery', 'city'));
    }
    public function active($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delivery_status = 1;
        $delivery->save();
        return back();
    }
    public function inactive($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delivery_status = 0;
        $delivery->save();
        return back();
    }
    public function delete($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delete();
        return back();
    }   
    public function update(Request $request){
        $delivery = Delivery::find($request->delivery_id);
        $delivery->delivery_name = $request->delivery_name;
        $delivery->delivery_phone_number = $request->delivery_phone_number;
        $delivery->order_number = $request->order_number;
        $delivery->save();
        return redirect('/delivery/boy/manage')->with('message', 'delivery Updated');
    }

    public Function InsertDelivery(){

    }
}
