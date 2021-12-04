<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Stripe;
use Session;

class stripeController extends Controller

{
    //payment view
    public function handleGet(){
        $categories = Category::where('category_status', 1)->get();
        return view('FrontEnd.checkout.stripe', compact('categories'));
    }

    //handle payment with post    
    public function handlePost(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $request->input('grandTotal'),
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => $request->name
        ]);

        // Session::flash('success', 'payment has been successfully processed...!');
        return redirect('/checkout/order/complete')->with('message','payment has been successfully processed...!');
    }

}
