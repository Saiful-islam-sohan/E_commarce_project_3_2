<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\ProductStoreRequest;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::where('is_active',1)->with('category')->latest('id')
        ->select(['id','category_id','name','slug','product_price','product_image','product_rating'])
        ->paginate();
        // return $products;
        return view('Admin.pages.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::select(['id','title'])->get();
        return view('Admin.pages.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        //dd($request->all());

        $product=Product::create([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'product_price'=>$request->product_price,
            'product_off_price'=>$request->product_off_price,
            'product_code'=>$request->product_code,
            'product_stock'=>$request->product_stock,
            'alert_quantity'=>$request->alert_quantity,
            'short_description'=>$request->sort_description,
            'long_discription_up'=>$request->long_discription_up,
            'short_discription_down'=>$request->short_discription_down,
            'delivary'=>$request->delivary,
        ]);

        $this->image_upload($request, $product->id);
        // $this->multiple_image__upload($request, $product->id);
        Toastr::success('product update successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $product=Product::whereSlug($slug)->first();
        $categories=Category::select(['id','title'])->get();
        return view('Admin.pages.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $product=Product::whereSlug($slug)->first();
        $product->update([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'product_price'=>$request->product_price,
            'product_off_price'=>$request->product_off_price,
            'product_code'=>$request->product_code,
            'product_stock'=>$request->product_stock,
            'alert_quantity'=>$request->alert_quantity,
            'short_description'=>$request->sort_description,
            'long_discription_up'=>$request->long_discription_up,
            'short_discription_down'=>$request->short_discription_down,
            'delivary'=>$request->delivary,
        ]);

        $this->image_upload($request, $product->id);
        // $this->multiple_image__upload($request, $product->id);
        Toastr::success('product update successfully!');
        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $product=Product::whereSlug($slug)->first()->delete();
        // if($product->product_image){
        //     $photo_location = 'uploads/product_photos/'.$product->product_image;
        //     unlink($photo_location);
        // }

        // $product->delete();

        return redirect()->route('products.index');
    }


    public function image_upload($request , $product_id)
    {
           $product=Product::findorFail($product_id);
           if($request->hasFile('product_image')){
            if($product->product_image !='default_product.jpg')
            {
                $photo_location='public/uploads/product_photos/';
                $old_photo_location = $photo_location . $product->product_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/product_photos/';
            $uploaded_photo = $request->file('product_image');
            $new_photo_name = $product->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600, 600)->save(base_path($new_photo_location), 40);
            $check = $product->update([
                'product_image' => $new_photo_name,
            ]);
           }

    }

}
