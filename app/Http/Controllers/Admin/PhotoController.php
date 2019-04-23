<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\photo\CreatePhotoRequest;
use App\Http\Requests\photo\UpdatePhotoRequest;
use App\Media;
use App\Photo;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::latest()->get();
        if ($photos->count() > 0 ){
            return view('admin.photo.index',compact('photos'));
        }else{
            $photo_id = Photo::max('id');
            return view('admin.photo.create',compact('photo_id'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $photo_id = Photo::max('id');
        return view('admin.photo.create',compact('photo_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePhotoRequest $request)
    {
        $image = $request->file('image');
        $slug = str_slug(str_limit($request->title,20));

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check News large dir is exists
            if (!file_exists('public/images/photo/large')) {
                mkdir('public/images/photo/large', 0777, true);
            }

            $directory = public_path('/images/photo/large/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(800, 800)->save($imageUrl);

            // check News small dir is exists
            if (!file_exists('public/images/photo/small')) {
                mkdir('public/images/photo/small', 0777, true);
            }

            $directory = public_path('/images/photo/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(500, 500)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/photo/original')) {
                mkdir('public/images/photo/original', 0777, true);
            }

            $image->move('public/images/photo/original',$imageName);

        } else {
            $imageName = "default.png";
        }
        $photo = new Photo();
        $photo->title = $request->title;
        $photo->slug = $slug;
        $photo->image = $imageName;


        if (isset($request->status))
        {
            $photo->status = true;
        }else
        {
            $photo->status = false;
        }

        $photo->save();
        Toastr::success('Media Successfully Saved :)' ,'Success');
        return redirect()->route('admin.photo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return view('admin.photo.show',compact('photo'));
    }

    public function uploadImage($photoId, Request $request)
    {
        $mediaphotoId = Photo::findOrFail($photoId);

        // get form image
        $image = $request->file('file');

        if (isset($image))
        {

            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check banner small dir is exists
            if (!file_exists('public/images/photo/media/small')) {
                mkdir('public/images/photo/media/small', 0777, true);
            }

            $directory = public_path('/images/photo/media/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(500, 500)->save($imageUrl);

            // check banner small dir is exists
            if (!file_exists('public/images/photo/media/large')) {
                mkdir('public/images/photo/media/large', 0777, true);
            }

            $directory = public_path('/images/photo/media/large/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(1300, 500)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/photo/media/original')) {
                mkdir('public/images/photo/media/original', 0777, true);
            }

            $image->move('public/images/photo/media/original',$imageName);

            $mediaphotoId->media()->create(['image' => $imageName]);

            Toastr::success('Media Successfully Saved :)' ,'Success');
            return redirect()->back();
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        return view('admin.photo.edit',compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $image = $request->file('image');
        $slug = str_slug(str_limit($request->title,20));

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check News large dir is exists
            if (!file_exists('public/images/photo/large')) {
                mkdir('public/images/photo/large', 0777, true);
            }
            unlink('public/images/photo/large/'.$photo->image);

            $directory = public_path('/images/photo/large/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(800, 800)->save($imageUrl);

            // check News small dir is exists
            if (!file_exists('public/images/photo/small')) {
                mkdir('public/images/photo/small', 0777, true);
            }
            unlink('public/images/photo/small/'.$photo->image);

            $directory = public_path('/images/photo/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(500, 500)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/photo/original')) {
                mkdir('public/images/photo/original', 0777, true);
            }
            unlink('public/images/photo/original/'.$photo->image);

            $image->move('public/images/photo/original',$imageName);

        } else {
            $imageName = $photo->image;
        }
        $photo->title = $request->title;
        $photo->slug = $slug;
        $photo->image = $imageName;


        if (isset($request->status))
        {
            $photo->status = true;
        }else
        {
            $photo->status = false;
        }

        $photo->save();

        Toastr::success('Media Successfully Updated :)' ,'Success');
        return redirect()->route('admin.photo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
       //return $photo;
        $medias = $photo->media()->get();

        //delete photo
        if (file_exists('public/images/photo/small/'.$photo->image)) {
            unlink('public/images/photo/small/'.$photo->image);
        }
        if (file_exists('public/images/photo/large/'.$photo->image)) {
            unlink('public/images/photo/large/'.$photo->image);
        }
        if (file_exists('public/images/photo/original/'.$photo->image)) {
            unlink('public/images/photo/original/'.$photo->image);
        }

        foreach ($medias  as $media)
        {
            //return $media->image;
            if (file_exists('public/images/photo/media/small/'.$media->image)) {
                unlink('public/images/photo/media/small/'.$media->image);
            }

            if (file_exists('public/images/photo/media/large/'.$media->image)) {
                unlink('public/images/photo/media/large/'.$media->image);
            }

            if (file_exists('public/images/photo/media/original/'.$media->image)) {
                unlink('public/images/photo/media/original/'.$media->image);
            }

        }


        $photo->delete();

        Toastr::success('Photo Successfully Deleted :)', 'Success');
        return redirect()->back();
    }

    public function destroymedia($id)
    {
        $media = Media::find($id);

        if (file_exists('public/images/photo/media/small/'.$media->image)) {
            unlink('public/images/photo/media/small/'.$media->image);
        }

        if (file_exists('public/images/photo/media/large/'.$media->image)) {
            unlink('public/images/photo/media/large/'.$media->image);
        }

        if (file_exists('public/images/photo/media/original/'.$media->image)) {
            unlink('public/images/photo/media/original/'.$media->image);
        }

        $media->delete();

        Toastr::success('Media Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
