<?php

namespace App\Http\Controllers\Admin;


use App\Brand;

use App\Http\Requests\brand\CreateBrandRequest;
use App\Http\Requests\brand\UpdateBrandRequest;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        if ($brands->count() > 0 ){
            return view('admin.brand.index',compact('brands'));
        }else{
            $brand_id = Brand::max('id');
            return view('admin.brand.create',compact('brand_id'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $brand_id = Brand::max('id');

        return view('admin.brand.create',compact('brand_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBrandRequest $request)
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
            if (!file_exists('public/images/brands/small')) {
                mkdir('public/images/brands/small', 0777, true);
            }

            $directory = public_path('/images/brands/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(170, 80)->save($imageUrl);


            //original image for banner
            if (!file_exists('public/images/brands/original')) {
                mkdir('public/images/brands/original', 0777, true);
            }
            $image->move('public/images/brands/original',$imageName);

        } else {
            $imageName = "default.png";
        }
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $slug;
        $brand->brand_link = $request->brand_link;
        $brand->image = $imageName;


        if (isset($request->status))
        {
            $brand->status = true;
        }else
        {
            $brand->status = false;
        }

        $brand->save();
        Toastr::success('Brand Successfully Saved :)' ,'Success');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('admin.brand.show',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
//        $this->validate($request,[
//            'name' => 'required|unique:brands,name'.$brand->id,
//            'brand_link' => 'required',
//            'image' => 'mimes:jpeg,bmp,png,jpg'
//        ]);
        // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/brands/small')) {
                mkdir('public/images/brands/small', 0777, true);
            }
            unlink('public/images/brands/small/'.$brand->image);

            $directory = public_path('/images/brands/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(170, 80)->save($imageUrl);


            //original image for banner
            if (!file_exists('public/images/brands/original')) {
                mkdir('public/images/brands/original', 0777, true);
            }
            unlink('public/images/brands/original/'.$brand->image);

            $image->move('public/images/brands/original',$imageName);

        } else {
            $imageName = $brand->image;
        }
        $brand->name = $request->name;
        $brand->slug = $slug;
        $brand->brand_link = $request->brand_link;
        $brand->image = $imageName;


        if (isset($request->status))
        {
            $brand->status = true;
        }else
        {
            $brand->status = false;
        }

        $brand->save();
        Toastr::success('Brand Successfully Updated :)' ,'Success');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if (file_exists('public/images/brands/small/'.$brand->image)) {
            unlink('public/images/brands/small/'.$brand->image);
        }

        if (file_exists('public/images/brands/original/'.$brand->image)) {
            unlink('public/images/brands/original/'.$brand->image);
        }
        $brand->delete();
        Toastr::success('Brand Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
