<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\management\CreateManagementRequest;
use App\Http\Requests\management\UpdateManagementRequest;
use App\Management;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managements = Management::latest()->get();
        if ($managements->count() > 0 ){
            return view('admin.management.index',compact('managements'));
        }else{
            $management_id = Management::max('id');
            return view('admin.management.create',compact('management_id'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $management_id = Management::max('id');
        return view('admin.management.create',compact('management_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateManagementRequest $request)
    {

    // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
     //     make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/managements/small')) {
                mkdir('public/images/managements/small', 0777, true);
            }

            $directory = public_path('/images/managements/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(170, 170)->save($imageUrl);

            // check banner long dir is exists
            if (!file_exists('public/images/managements/large')) {
                mkdir('public/images/managements/large', 0777, true);
            }

            $directory = public_path('/images/managements/large/');
            $imageUrl = $directory.$imageName;
            //resize big image for banner
            Image::make($image)->resize(170, 170)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/managements/original')) {
                mkdir('public/images/managements/original', 0777, true);
            }
            $image->move('public/images/managements/original',$imageName);

        } else {
            $imageName = "default.png";
        }
        $management = new Management();
        $management->name = $request->name;
        $management->designation = $request->designation;
        $management->facebook_url = $request->facebook_url;
        $management->twitter_url = $request->twitter_url;
        $management->googleplus_url = $request->googleplus_url;
        $management->linkedin_url = $request->linkedin_url;
        $management->slug = $slug;
        $management->image = $imageName;
        $management->description = $request->description;

        if (isset($request->status))
        {
            $management->status = true;
        }else
        {
            $management->status = false;
        }

        $management->save();

        Toastr::success('Management Team Member Successfully Saved :)' ,'Success');
        return redirect()->route('admin.management.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function show(Management $management)
    {
        return view('admin.management.show',compact('management'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function edit(Management $management)
    {
        return view('admin.management.edit',compact('management'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateManagementRequest $request, Management $management)
    {
        // get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
            //     make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/managements/small')) {
                mkdir('public/images/managements/small', 0777, true);
            }

            unlink('public/images/managements/small/'.$management->image);

            $directory = public_path('/images/managements/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(170, 170)->save($imageUrl);

            // check banner long dir is exists
            if (!file_exists('public/images/managements/large')) {
                mkdir('public/images/managements/large', 0777, true);
            }

            unlink('public/images/managements/large/'.$management->image);

            $directory = public_path('/images/managements/large/');
            $imageUrl = $directory.$imageName;
            //resize big image for banner
            Image::make($image)->resize(170, 170)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/managements/original')) {
                mkdir('public/images/managements/original', 0777, true);
            }

            unlink('public/images/managements/original/'.$management->image);
            $image->move('public/images/managements/original',$imageName);

        } else {
            $imageName = $management->image;
        }

        $management->name = $request->name;
        $management->designation = $request->designation;
        $management->facebook_url = $request->facebook_url;
        $management->twitter_url = $request->twitter_url;
        $management->googleplus_url = $request->googleplus_url;
        $management->linkedin_url = $request->linkedin_url;
        $management->slug = $slug;
        $management->image = $imageName;
        $management->description = $request->description;

        if (isset($request->status))
        {
            $management->status = true;
        }else
        {
            $management->status = false;
        }

        $management->save();

        Toastr::success('Management Team Member Successfully Saved :)' ,'Success');
        return redirect()->route('admin.management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function destroy(Management $management)
    {
        if (file_exists('public/images/managements/small/'.$management->image)) {
            unlink('public/images/managements/small/'.$management->image);
        }
        if (file_exists('public/images/managements/large/'.$management->image)) {
            unlink('public/images/managements/large/'.$management->image);
        }
        if (file_exists('public/images/managements/original/'.$management->image)) {
            unlink('public/images/managements/original/'.$management->image);
        }

        $management->delete();

        Toastr::success('Management Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
