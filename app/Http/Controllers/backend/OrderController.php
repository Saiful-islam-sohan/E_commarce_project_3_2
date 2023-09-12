<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class OrderController extends Controller
{
    public function index()
    {
       $orders=Order::with(['billing','orderdetails'])->latest('id')->paginate();
      // return $order;

      return view('Admin.pages.order.index',compact('orders'));
    }
}
