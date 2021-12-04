<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class orderController extends Controller
{
    public function manage(){
        $orders = DB::table('orders')
                    ->join('customers', 'orders.customer_id', '=', 'customers.customer_id')
                    ->join('payments', 'orders.order_id', '=', 'payments.order_id')
                    ->select('orders.*', 'customers.name', 'payments.payment_type', 'payments.payment_status')
                    ->get();

        return view('BackEnd.Order.manage', compact('orders'));
    }

    public function viewOrder($order_id){
        $order = Order::find($order_id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $payment = Payment::where('order_id', $order->order_id)->first();
        $order_details = OrderDetail::where('order_id', $order->order_id)->get();

        return view('BackEnd.Order.view_order', compact('order', 'customer', 'shipping', 'payment', 'order_details'));
    }

    public function viewInvoice($order_id){
        $order = Order::find($order_id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $payment = Payment::where('order_id', $order->order_id)->first();
        $order_details = OrderDetail::where('order_id', $order->order_id)->get();

        return view('BackEnd.Order.view_order_invoice', compact('order', 'customer', 'shipping', 'payment', 'order_details'));
    }
    
    public function downloadInvoice($order_id){
        $order = Order::find($order_id);
        $customer = Customer::find($order->customer_id);
        $shipping = Shipping::find($order->shipping_id);
        $payment = Payment::where('order_id', $order->order_id)->first();
        $order_details = OrderDetail::where('order_id', $order->order_id)->get();

        $pdf = PDF::loadView('BackEnd.Order.download_order_invoice', compact('order', 'customer', 'shipping', 'payment', 'order_details'));
        return $pdf->stream('OrderInvoice.pdf');
    }


    public function delete($order_id){
        $order = Order::find($order_id);
        $order->delete();
        return back()->with('message', 'Order Deleted Successfully');
    } 

}
