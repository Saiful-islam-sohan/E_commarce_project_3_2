<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;


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

        $sels=Product::where('is_active',1)->latest('id')
        ->select(['id','name','slug','product_price','product_off_price','short_discription',
        'delivary','long_discription_up','short_discription_down','product_image','product_rating'])
        ->paginate(8);





        return view('frontend.pages.home',compact('categories','products','sels'));
    }

    public function ProductDatiles($product_slug){
        $product=Product::whereSlug($product_slug)
        ->with('category','productImages')
        ->first();

        $related_product=Product::whereNot('slug', $product_slug)
        ->select(['id','name','slug','product_price','product_off_price','short_discription',
        'delivary','long_discription_up','short_discription_down','product_image','product_rating'])
        ->limit(4)
        ->get();
        return view('frontend.pages.related_product',compact('product','related_product'));

    }

    public function nevDeatils()
    {
        $womensfashons=Category::where('slug','pant')
        ->orWhere('slug','dresses')
        ->orWhere('slug','shirts')
        ->orWhere('slug','hoodies')
        ->orWhere('slug','prom')
        ->orWhere('slug','cap')
        ->limit(6)
        ->select(['id','slug'])
        ->get();

         //return $womensfashons;

        return view('frontend.layouts.inc.header',compact('womensfashons'));







    }


}
