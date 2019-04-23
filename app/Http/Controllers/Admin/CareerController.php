<?php

namespace App\Http\Controllers\Admin;

use App\Career;
use App\Http\Requests\career\CreateCareerRequest;
use App\Http\Requests\career\UpdateCareerRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers = Career::latest()->get();
        if ($careers->count() > 0 ){
            return view('admin.career.index',compact('careers'));
        }else{

            return view('admin.career.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.career.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCareerRequest $request)
    {
        $slug = str_slug($request->title);

        $career = new Career();
        $career->title = $request->title;
        $career->slug = $slug;
        $career->description = $request->description;


        if (isset($request->status))
        {
            $career->status = true;
        }else
        {
            $career->status = false;
        }

        $career->save();

        Toastr::success('Career Successfully Saved :)' ,'Success');
        return redirect()->route('admin.career.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        return view('admin.career.show',compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        return view('admin.career.edit',compact('career'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCareerRequest $request, Career $career)
    {
        $slug = str_slug($request->title);

        $career->title = $request->title;
        $career->slug = $slug;
        $career->description = $request->description;


        if (isset($request->status))
        {
            $career->status = true;
        }else
        {
            $career->status = false;
        }

        $career->save();

        Toastr::success('Career Successfully Updated :)' ,'Success');
        return redirect()->route('admin.career.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {

        $career->delete();
        Toastr::success("Career Successfully Deleted :)", "Success");
        return redirect()->back();
    }
}
