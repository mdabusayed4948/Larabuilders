<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    {
        //return $request;
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);

        $image = $request->file('image');

        $slug = str_slug($request->name);

        $user = User::findOrFail(Auth::id());

        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();

            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

           // check category dir is exists
            if (!file_exists('public/images/profile')) {
                mkdir('public/images/profile', 0777, true);
            }

            // delete old category image
            if (file_exists('public/images/profile/'.$user->image)) {
                unlink('public/images/profile/'.$user->image);
            }

            $directory = public_path('/images/profile/');
            $imageUrl = $directory.$imageName;
            Image::make($image)->resize(200, 200)->save($imageUrl);


        }else {
            $imageName = $user->image;
        }

        $user->name = $request->name;

        $user->email = $request->email;

        $user->image = $imageName;

        $user->about = $request->about;

        $user->save();

        Toastr::success('Profile Successfully Updated :)' ,'Success');
        return redirect()->back();

    }

    public function updatePassword(Request $request)
    {
        //return $request;

        $this->validate($request,[

            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password,$hashedPassword))
        {

          if (!Hash::check($request->password,$hashedPassword))
          {
            $user = User::findOrFail(Auth::id());

              $user->password = Hash::make($request->password);

              $user->save();

              Toastr::success('Password Successfully Changed :)' ,'Success');

              Auth::logout();

              return redirect()->back();

          }else{

              Toastr::error('New password cannot be the same as old password :)' ,'Error');

              return redirect()->back();

          }

        }else{

            Toastr::error('Current Password not match' ,'Error');

            return redirect()->back();

        }
    }
}
