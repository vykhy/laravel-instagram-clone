<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * This page is restricted to authenticated users only
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        /**
         * Fetch posts from users who are followed by the current user
         * Return view of those posts, ordered by latest, paginated to 20
         */
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(20);

        return view('posts.index', compact('posts'));
    }

    public function create(){
        /**
         * Return the view to create a new post
         * This view contains a form
         */
        return view('posts.create');
    }

    public function store(){
        /**
         * Function to store new post along with uploaded image
         */

         //validate the data
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required | image',
        ]);

        //set new image path to uploaded directory -public/uploads
        $imagePath = request('image')->store('uploads', 'public');

        //save the image to the path, resize the image and save
        $image = Image::make(public_path('/storage/'.$imagePath))->fit(1200, 1200);
        $image->save();

        //finally create the post under currently authenticated user
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        //redirect to user's profile
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        /**
         * Returns a view with a single post and details of that post(user, caption)
         */
        return view('posts.show', compact('post'));
    }
}
