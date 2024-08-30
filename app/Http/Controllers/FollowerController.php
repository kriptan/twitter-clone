<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowerController extends Controller
{
    /**
     * Follow a user.
     *
     * @param \App\Models\User $user The user to follow.
     * @return \Illuminate\Http\RedirectResponse Redirects to the user's profile page with a success message.
     */
    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->followings()->attach($user->id);
        return redirect()->route('users.show', $user->id)->with('success', 'You are now following this user.');
    }

    /**
     * Unfollow a user.
     *
     * @param \App\Models\User $user The user to unfollow.
     * @return \Illuminate\Http\RedirectResponse Redirects to the user's profile page with a success message.
     */
    public function unfollow($user)
    {
        $follower = auth()->user();
        $follower->followings()->detach($user);
        return redirect()->route('users.show', $user)->with('success', 'You are no longer following this user.');
    }
}
