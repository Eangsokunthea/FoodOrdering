<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\DB;

class frontEndController extends Controller
{
    public function index(){
        $categories = Category::where('category_status', 1)->get();
        $dishes = Dish::where('dish_status', 1)->get();
        return view('FrontEnd.include.home', compact('categories', 'dishes'));
    }

    public function allDish(){
        $categories = Category::where('category_status', 1)->orderby('category_id','desc')->get();
        $dishes = Dish::where('dish_status', 1)->orderby('dish_id','desc')->get();
        
        $all_dish = DB::table('dishes')->where('dish_status','1')->orderby(DB::raw('RAND()'))->paginate(6); 

        return view('FrontEnd.include.view_all_dish', compact('categories', 'dishes', 'all_dish'));
    }

    public function dish_show($id){
        $categories = Category::where('category_status', 1)->get();
        $categoryDish = Dish::where('category_id', $id)
                            ->where('dish_status', 1)
                            ->get();
        return view('FrontEnd.include.dish', compact('categories', 'categoryDish'));
    }

    public function search(Request $request){
        $categories = Category::where('category_status', 1)->get();
      
        $keywords = $request->keywords_submit;
        $search_dish = Dish::where('dish_name','like','%'.$keywords.'%')->get();
        
        return view('FrontEnd.include.search', compact('categories', 'search_dish'));
    }

    public function trove(){
        Cart::destroy();
        return redirect('/');
    }
}
