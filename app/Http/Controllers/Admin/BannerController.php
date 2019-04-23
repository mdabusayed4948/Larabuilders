<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Requests\banner\CreateBannerRequest;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        if ($banners->count() > 0 ){
             return view('admin.banner.index',compact('banners'));
        }else{
            $banner_id = Banner::max('id');
            return view('admin.banner.create',compact('banner_id'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner_id = Banner::max('id');

        return view('admin.banner.create',compact('banner_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request)
    {

        // get form image
        $image = $request->file('image');
        $slug = str_slug(str_limit($request->title,"20"));

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

           // check banner small dir is exists
            if (!file_exists('public/images/banners/small')) {
                mkdir('public/images/banners/small', 0777, true);
            }

            $directory = public_path('/images/banners/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(370, 250)->save($imageUrl);

            // check banner long dir is exists
            if (!file_exists('public/images/banners/large')) {
                mkdir('public/images/banners/large', 0777, true);
            }

            $directory = public_path('/images/banners/large/');
            $imageUrl = $directory.$imageName;
            //resize big image for banner
            Image::make($image)->resize(1900, 582)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/banners/original')) {
                mkdir('public/images/banners/original', 0777, true);
            }
            $image->move('public/images/banners/original',$imageName);

        } else {
            $imageName = "default.png";
        }
        $banner = new Banner();
        $banner->title = $request->title;
        $banner->slug = $slug;
        $banner->image = $imageName;
        $banner->body = $request->body;

        if (isset($request->status))
        {
            $banner->status = true;
        }else
        {
            $banner->status = false;
        }

        $banner->save();
        Toastr::success('Banner Successfully Saved :)' ,'Success');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('admin.banner.show',compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {

        // get form image
        $image = $request->file('image');
        $slug = str_slug(str_limit($request->title,"20"));

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/banners/small')) {
                mkdir('public/images/banners/small', 0777, true);
            }
            unlink('public/images/banners/small/'.$banner->image);

            $directory = public_path('/images/banners/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(370, 250)->save($imageUrl);

            // check banner long dir is exists
            if (!file_exists('public/images/banners/large')) {
                mkdir('public/images/banners/large', 0777, true);
            }
            unlink('public/images/banners/large/'.$banner->image);

            $directory = public_path('/images/banners/large/');
            $imageUrl = $directory.$imageName;
            //resize big image for banner
            Image::make($image)->resize(1900, 582)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/banners/original')) {
                mkdir('public/images/banners/original', 0777, true);
            }
            unlink('public/images/banners/original/'.$banner->image);
            $image->move('public/images/banners/original',$imageName);

        } else {
            $imageName =  $banner->image;
        }
        $banner->title = $request->title;
        $banner->slug = $slug;
        $banner->image = $imageName;
        $banner->body = $request->body;

        if (isset($request->status))
        {
            $banner->status = true;
        }else
        {
            $banner->status = false;
        }

        $banner->save();
        Toastr::success('Banner Successfully Updated :)' ,'Success');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
         if (file_exists('public/images/banners/small/'.$banner->image)) {
            unlink('public/images/banners/small/'.$banner->image);
         }
         if (file_exists('public/images/banners/large/'.$banner->image)) {
            unlink('public/images/banners/large/'.$banner->image);
         }
         if (file_exists('public/images/banners/original/'.$banner->image)) {
            unlink('public/images/banners/original/'.$banner->image);
         }
        $banner->delete();
        Toastr::success('Banner Successfully Deleted :)', 'Success');
        return redirect()->back();

    }
}
