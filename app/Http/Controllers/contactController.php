<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Cart;

class contactController extends Controller
{
    public function contact(){
        $CartDish = Cart::content();
        $city = City::orderby('matp','ASC')->get();
        $categories = Category::where('category_status', 1)->get();
        return view('FrontEnd.contact.contact', compact('CartDish', 'categories', 'city'));
    }
}
