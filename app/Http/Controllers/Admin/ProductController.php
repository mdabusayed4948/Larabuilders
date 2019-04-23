<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\product\CreateProductRequest;
use App\Http\Requests\product\UpdateProductRequest;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        if ($products->count() > 0 ){
            return view('admin.product.index',compact('products'));
        }else{
            $product_id = Product::max('id');
            return view('admin.product.create',compact('product_id'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_id = Product::max('id');
        return view('admin.product.create',compact('product_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/products/small')) {
                mkdir('public/images/products/small', 0777, true);
            }

            $directory = public_path('/images/products/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(370, 200)->save($imageUrl);

            // check banner long dir is exists
            if (!file_exists('public/images/products/large')) {
                mkdir('public/images/products/large', 0777, true);
            }

            $directory = public_path('/images/products/large/');
            $imageUrl = $directory.$imageName;
            //resize big image for banner
            Image::make($image)->resize(830, 475)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/products/original')) {
                mkdir('public/images/products/original', 0777, true);
            }
            $image->move('public/images/products/original',$imageName);

        } else {
            $imageName = "default.png";
        }
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $slug;
        $product->image = $imageName;
        $product->short_description = $request->short_description;
        $product->description = $request->description;

        if (isset($request->status))
        {
            $product->status = true;
        }else
        {
            $product->status = false;
        }

        $product->save();

        Toastr::success('Product Successfully Saved :)' ,'Success');
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/products/small')) {
                mkdir('public/images/products/small', 0777, true);
            }

            unlink('public/images/products/small/'.$product->image);

            $directory = public_path('/images/products/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(370, 200)->save($imageUrl);

            // check banner long dir is exists
            if (!file_exists('public/images/products/large')) {
                mkdir('public/images/products/large', 0777, true);
            }

            unlink('public/images/products/large/'.$product->image);

            $directory = public_path('/images/products/large/');
            $imageUrl = $directory.$imageName;
            //resize big image for banner
            Image::make($image)->resize(830, 475)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/products/original')) {
                mkdir('public/images/products/original', 0777, true);
            }

            unlink('public/images/products/original/'.$product->image);
            $image->move('public/images/products/original',$imageName);

        } else {
            $imageName = $product->image;
        }

        $product->name = $request->name;
        $product->slug = $slug;
        $product->image = $imageName;
        $product->short_description = $request->short_description;
        $product->description = $request->description;

        if (isset($request->status))
        {
            $product->status = true;
        }else
        {
            $product->status = false;
        }

        $product->save();

        Toastr::success('Product Successfully Saved :)' ,'Success');
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if (file_exists('public/images/products/small/'.$product->image)) {
            unlink('public/images/products/small/'.$product->image);
        }

        if (file_exists('public/images/products/large/'.$product->image)) {
            unlink('public/images/products/large/'.$product->image);
        }

        if (file_exists('public/images/products/original/'.$product->image)) {
            unlink('public/images/products/original/'.$product->image);
        }

        $product->delete();

        Toastr::success('Product Successfully Deleted :)', 'Success');
        return redirect()->back();

    }

}
