<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.profile');
    }

    public function profileDetails()
    {
        $user = Auth::user();
        $user->profile;
        return response(['user' => $user], 200);
    }

    public function update(Request $request)
    {
   
        $user = Auth::user()->profile()->update($request->except('id'));
        return response(['user' => $user], 201);
    }

    public function updateProfilePicture(Request $request)
    {
        if ($request->hasFile('profile_pic')) {
            $file_name = time().'.'.request()->profile_pic->getClientOriginalExtension();
            Image::make($request->file('profile_pic'))->save( public_path('avatars/'.$file_name) );
            $profile = Profile::where('user_id', Auth::user()->id)->update([
                'profile_pic' => $file_name
            ]);
            return response(['file' => $file_name], 201);
        }
    }
}
