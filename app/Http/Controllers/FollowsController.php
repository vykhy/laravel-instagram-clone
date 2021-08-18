<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        /**
         * Toggle between following and unfollowing a user's profile by the current user
         */
        return auth()->user()->following()->toggle($user->profile);
    }
}
