<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::latest('id')->select(['id','title','slug','category_image','updated_at'])->paginate();
        //return $categories;
       return view('Admin.pages.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        //dd($request->all());
       $category= Category::create([
              'title'=>$request->title,
              'slug'=>Str::slug($request->title)
        ]);

        $this->image_upload($request,$category->id);

        Toastr::success('category store successfully!');
        return redirect()->route('categories.index');
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
       // dd($slug);

       $category=Category::whereSlug($slug)->first();
       //return $category;

       return view('Admin.pages.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $slug)
    {
        //dd($request->all());
        $category=Category::whereSlug($slug)->first();

        $category->update([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'is_active'=>$request->filled('is_active'),
      ]);

      $this->image_upload($request,$category->id);

      Toastr::successs('category update successfully!');
      return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $category=Category::whereSlug($slug)->first()->delete();
        // if($category->category_image)
        // {
        //     $photo_location = 'uploads/category/'.$category->category_image;
        //     unlink($photo_location);
        // }
        // $category->delete();



        return redirect()->route('categories.index');
        //return $category;
    }

    public function image_upload($request , $item_id)
    {
          $category=Category::findorFail($item_id);
          //dd($request->all());
          if($request->hasFile('category_image')){
            if($category->category_image !='default-image.jpg'){
                $photo_location = 'public/uploads/category/';
                $old_photo_location = $photo_location . $category->category_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/category/';
            $uploaded_photo = $request->file('category_image');
            $new_photo_name = $category->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(300,260)->save(base_path($new_photo_location), 40);
            //$user = User::find($category->id);
            $check = $category->update([
                'category_image' => $new_photo_name,
            ]);

          }

    }
}
