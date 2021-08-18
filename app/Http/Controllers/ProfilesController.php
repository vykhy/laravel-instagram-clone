<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user)
    {
        /**
         * Returns a view of the profile of a user
         * Along with profile details and whether current user follows it
         */

         //if current user is authenticated, get whether current user follows it
        $follows = (auth()->user()) ? auth()->user()->following->contains($user) : false ;

        //get the user or retun 404 if not found
        $user = User::findOrFail($user);

        /**
        *get number of posts, followers and following of user and cache for 30 seconds
        */
        $postCount = Cache::remember(
            'count.posts'. $user->id, 
            now()->addSeconds(30), function() use ($user){
            return $user->posts->count();
        }) ;
        
        $followersCount = Cache::remember(
            'count.followers'. $user->id, 
            now()->addSeconds(30), function() use ($user){
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember(
            'count.following'. $user->id, 
            now()->addSeconds(30), function() use ($user){
            return $user->following->count();
        });

        /**
         * Finally return view with the data
         */
        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount
        ]);
    }

    public function edit(User $user)
    {
        /**
         * Return view with a form to edit user profile
         * Only if user is authorized (profile of own user)
         */
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        /**
         * Function to update the profile details from 'edit profile' page
         * Only if authorized
         */
        $this->authorize('update', $user->profile);

        //validate data
        $data = request()->validate([
            'title' => '',
            'description' => '',
            'url' => '',
            'image' => ''
        ]);

        //set new image path and upload image if new image is set
        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');

            //make, resize and save image
            $image = Image::make(public_path('/storage/'.$imagePath))->fit(1200, 1200);
            $image->save();

            //return as array so that we may merge seamlessly
            //required because new image may not alway be provided and we do not want to remove old image
            $imageArray = ['image' => $imagePath];
        }

        //update the profile data as that of current user
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        //redirect to profile page
        return redirect('/profile/'.$user->id );

    }
}
