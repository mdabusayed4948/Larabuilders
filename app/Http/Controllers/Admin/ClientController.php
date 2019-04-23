<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Requests\client\CreateClientRequest;
use App\Http\Requests\client\UpdateClientRequest;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->get();
        if ($clients->count() > 0 ){
            return view('admin.client.index',compact('clients'));
        }else{
            $client_id = Client::max('id');
            return view('admin.client.create',compact('client_id'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client_id = Client::max('id');
        return view('admin.client.create',compact('client_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClientRequest $request)
    {
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/clients/small')) {
                mkdir('public/images/clients/small', 0777, true);
            }

            $directory = public_path('/images/clients/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(80, 80)->save($imageUrl);


            //original image for banner
            if (!file_exists('public/images/clients/original')) {
                mkdir('public/images/clients/original', 0777, true);
            }
            $image->move('public/images/clients/original',$imageName);

        } else {
            $imageName = "default.png";
        }
        $client = new Client();
        $client->name = $request->name;
        $client->slug = $slug;
        $client->designation = $request->designation;
        $client->company = $request->company;
        $client->image = $imageName;


        if (isset($request->status))
        {
            $client->status = true;
        }else
        {
            $client->status = false;
        }

        $client->save();
        Toastr::success('Client information Successfully Saved :)' ,'Success');
        return redirect()->route('admin.client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.client.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/clients/small')) {
                mkdir('public/images/clients/small', 0777, true);
            }
            unlink('public/images/clients/small/'.$client->image);

            $directory = public_path('/images/clients/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(80, 80)->save($imageUrl);


            //original image for banner
            if (!file_exists('public/images/clients/original')) {
                mkdir('public/images/clients/original', 0777, true);
            }
            unlink('public/images/clients/original/'.$client->image);

            $image->move('public/images/clients/original',$imageName);

        } else {
            $imageName = $client->image;
        }
        $client->name = $request->name;
        $client->slug = $slug;
        $client->designation = $request->designation;
        $client->company = $request->company;
        $client->image = $imageName;


        if (isset($request->status))
        {
            $client->status = true;
        }else
        {
            $client->status = false;
        }

        $client->save();
        Toastr::success('Client information Successfully Updated :)' ,'Success');
        return redirect()->route('admin.client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if (file_exists('public/images/clients/small/'.$client->image)) {
            unlink('public/images/clients/small/'.$client->image);
        }

        if (file_exists('public/images/clients/original/'.$client->image)) {
            unlink('public/images/clients/original/'.$client->image);
        }
        $client->delete();
        Toastr::success("Client's Information Successfully Deleted :)", "Success");
        return redirect()->back();
    }
}
