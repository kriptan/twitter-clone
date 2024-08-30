<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->attach($user->id);
        return redirect()->route('users.show', $user->id)->with('success', 'You are now following this user.');
    }

    public function unfollow($user)
    {
        $follower = auth()->user();
        $follower->followings()->detach($user);
        return redirect()->route('users.show', $user)->with('success', 'You are no longer following this user.');
    }
}
