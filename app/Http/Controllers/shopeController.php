<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class shopeController extends Controller
{
    public function index(){
        $categories = Category::where('is_active', 1)
        ->latest('id')
        ->limit(10)
        ->select(['id', 'title'])
        ->get();
        return view('frontend.pages.shope',compact('categories'));
    }


}
