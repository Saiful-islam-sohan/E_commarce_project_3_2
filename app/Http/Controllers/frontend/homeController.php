<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function home(){

        $categories = Category::where('is_active', 1)
        ->latest('id')
        ->limit(10)
        ->select(['id', 'title', 'category_image','slug'])
        ->get();

        $products=Product::where('is_active',1)->latest('id')
        ->select(['id','name','slug','product_price','product_off_price','short_discription',
        'delivary','long_discription_up','short_discription_down','product_image','product_rating'])
        ->paginate(12);





        return view('frontend.pages.home',compact('categories','products'));
    }


}
