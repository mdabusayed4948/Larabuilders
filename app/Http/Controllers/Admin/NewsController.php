<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\news\CreateNewsRequest;
use App\Http\Requests\news\UpdateNewsRequest;
use App\News;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsdata = News::latest()->get();
        if ($newsdata->count() > 0 ){
            return view('admin.news.index',compact('newsdata'));
        }else{
            $news_id = News::max('id');
            return view('admin.news.create',compact('news_id'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news_id = News::max('id');
        return view('admin.news.create',compact('news_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewsRequest $request)
    {
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // check News large dir is exists
            if (!file_exists('public/images/news/large')) {
                mkdir('public/images/news/large', 0777, true);
            }

            $directory = public_path('/images/news/large/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(830, 476)->save($imageUrl);

            // check News small dir is exists
            if (!file_exists('public/images/news/small')) {
                mkdir('public/images/news/small', 0777, true);
            }

            $directory = public_path('/images/news/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(255, 138)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/news/original')) {
                mkdir('public/images/news/original', 0777, true);
            }
            $image->move('public/images/news/original',$imageName);

        } else {
            $imageName = "default.png";
        }
        $news = new News();
        $news->title = $request->title;
        $news->slug = $slug;
        $news->description = $request->description;
        $news->news_date = $request->news_date;
        $news->image = $imageName;


        if (isset($request->status))
        {
            $news->status = true;
        }else
        {
            $news->status = false;
        }

        $news->save();
        Toastr::success('News Successfully Saved :)' ,'Success');
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.show',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit',compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image))
        {
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();


            // check news long dir is exists
            if (!file_exists('public/images/news/large')) {
                mkdir('public/images/news/large', 0777, true);
            }
            unlink('public/images/news/large/'.$news->image);


            $directory = public_path('/images/news/large/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(830, 476)->save($imageUrl);

            // check news small dir is exists
            if (!file_exists('public/images/news/small')) {
                mkdir('public/images/news/small', 0777, true);
            }
            unlink('public/images/news/small/'.$news->image);

            $directory = public_path('/images/news/small/');
            $imageUrl = $directory.$imageName;
            //resize small image for banner
            Image::make($image)->resize(255, 138)->save($imageUrl);

            //original image for banner
            if (!file_exists('public/images/news/original')) {
                mkdir('public/images/news/original', 0777, true);
            }
            unlink('public/images/news/original/'.$news->image);
            $image->move('public/images/news/original',$imageName);

        } else {
            $imageName = $news->image;
        }
        $news->title = $request->title;
        $news->slug = $slug;
        $news->description = $request->description;
        $news->news_date = $request->news_date;
        $news->image = $imageName;


        if (isset($request->status))
        {
            $news->status = true;
        }else
        {
            $news->status = false;
        }

        $news->save();
        Toastr::success('News Successfully Updated :)' ,'Success');
        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if (file_exists('public/images/news/small/'.$news->image)) {
            unlink('public/images/news/small/'.$news->image);
        }

        if (file_exists('public/images/news/large/'.$news->image)) {
            unlink('public/images/news/large/'.$news->image);
        }

        if (file_exists('public/images/news/original/'.$news->image)) {
            unlink('public/images/news/original/'.$news->image);
        }
        $news->delete();
        Toastr::success("News Successfully Deleted :)", "Success");
        return redirect()->back();
    }
}
