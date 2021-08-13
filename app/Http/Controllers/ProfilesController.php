<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user);
        $user->profile = Profile::find($user->id);
        return view('profiles.index', [
            'user' => $user,
        ]);
    }
}
