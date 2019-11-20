<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');

    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
       $update =  auth()->user()->update(array('firstname' => $request->firstname, 'lastname' => $request->lastname));



        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function pictures(ProfilePicture $request){

       $path = $request->file('propic')->store('images');

       $update = auth()->user()->update(array('image_url' => $path));

       return redirect()->back()->with('status','Profile picture changed');


    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
