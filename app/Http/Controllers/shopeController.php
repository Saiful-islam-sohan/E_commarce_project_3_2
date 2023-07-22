<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class shopeController extends Controller
{
    public function index(){
        $categories = Category::where('is_active', 1)
        ->with('')
        ->latest('id')
        ->limit(10)
        ->select(['id', 'title','slug'])
        ->get();

        $products=Product::where('is_active',1)->latest('id')
        ->select(['id','name','slug','product_price','product_off_price','short_discription',
        'delivary','long_discription_up','short_discription_down','product_image','product_rating'])
        ->paginate(12);
        return view('frontend.pages.shope',compact('categories','products'));
    }


}
