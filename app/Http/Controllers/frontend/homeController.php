<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function home(){

        $categories = Category::where('is_active', 1)
        ->latest('id')
        ->limit(10)
        ->select(['id', 'title', 'category_image','slug'])
        ->get();





        return view('frontend.pages.home',compact('categories'));
    }
}
