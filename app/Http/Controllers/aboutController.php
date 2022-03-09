<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use Cart;
class aboutController extends Controller
{
    public function about(){
        $CartDish = Cart::content();
        $city = City::orderby('matp','ASC')->get();
        $categories = Category::where('category_status', 1)->get();
        return view('FrontEnd.about.about', compact('CartDish', 'categories', 'city'));
    }
}
