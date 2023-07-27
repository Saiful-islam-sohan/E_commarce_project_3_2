<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryWiseController extends Controller
{
    public function list($id)
    {
        $categories = Category::where('is_active', 1)
        ->with('products')
        ->latest('id')
        ->limit(10)
        ->select(['id', 'title','slug'])
        ->get();

        $products=Product::where('is_active',1)
        ->where('category_id', $id)
        ->limit(10)
        // ->latest('id')


        ->select(['id','name','slug','product_price','product_off_price','short_discription',
        'delivary','long_discription_up','short_discription_down','product_image','product_rating'])
        ->paginate(12);
        return view('frontend.pages.category-wise',compact('categories','products'));




    }
}
