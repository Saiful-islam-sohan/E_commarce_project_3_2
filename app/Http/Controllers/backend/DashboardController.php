<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){

        $total_earning=OrderDetails::sum('product_price');
        $total_order_count=Order::count();
        $total_categories=Category::count();
        $total_products=Product::count();

        //return $total_categories;
        return view('Admin.pages.dashboard',compact(
            'total_earning',
            'total_order_count',
            'total_categories',
            'total_products'
        ));
    }
}
