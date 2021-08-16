<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user) : false ;

        $user = User::findOrFail($user);
        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => '',
            'description' => '',
            'url' => '',
            'image' => ''
        ]);

        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path('/storage/'.$imagePath))->fit(1200, 1200);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect('/profile/'.$user->id );

    }
}
