<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Feeship;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\OrderDetails;

class OrderController extends Controller
{
    public function view_order($order_code)
    {
        $order_details = OrderDetails::with('product')->where('order_code', $order_code)->get();
        $orders = Order::where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->first();
        $customer = Customer::findOrFail($order->customer_id);
        $shipping = Shipping::findOrFail($order->shipping_id);

        // Get product coupon details
        $product_coupon = 'no';
        $order_details_product = OrderDetails::with('product')
                                ->where('order_code', $order_code)
                                ->first();
        
        if ($order_details_product) {
            $product_coupon = $order_details_product->product_coupon;
        }
        
        // Set coupon values
        $coupon_condition = 2;
        $coupon_number = 0;
        
        if ($product_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            if ($coupon) {
                $coupon_condition = $coupon->coupon_condition;
                $coupon_number = $coupon->coupon_number;
            }
        }
    
        return view('admin.view_order', compact(
            'order_details',
            'orders', 
            'order',
            'customer',
            'shipping',
            'coupon_condition',
            'coupon_number',
            'product_coupon'
        ));
    }

    public function manage_order()
    {
        $order = Order::orderby('created_at', 'DESC')->paginate(5);
        return view('admin.manage_order', compact('order'));
    }
}