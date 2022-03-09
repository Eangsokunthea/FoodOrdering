<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product_count = Dish::count();
        $order_count = Order::count();
        $cus_count = Customer::count();
        $user_count = User::count();
        $orders = DB::table('orders')
                    ->join('customers', 'orders.customer_id', '=', 'customers.customer_id')
                    ->join('payments', 'orders.order_id', '=', 'payments.order_id')
                    ->select('orders.*', 'customers.name', 'payments.payment_type', 'payments.payment_status')
                    ->orderby('orders.order_id','desc')
                    ->get();

        $curent_month_orders = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $before_1_month_orders = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(1))->count();                
        $before_2_month_orders = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        $before_3_month_orders = Order::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(3))->count();
        $ordersCount = array($curent_month_orders, $before_1_month_orders, 
            $before_2_month_orders, $before_3_month_orders);  

        return view('BackEnd.Home.home', compact('orders','product_count', 'order_count', 'cus_count', 'user_count', 'ordersCount'));
    }
    
    public function show_cus(){
        $customers = Customer::all();
        return view('BackEnd.customer.customer', compact('customers'));
    }

    public function delete($customer_id){
        $customer = Customer::find($customer_id);
        $customer->delete();
        return back();
    } 

 

}
