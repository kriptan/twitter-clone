<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class IdeaLikeController extends Controller
{
    public function like(Idea $idea)
    {
        $liker = auth()->user(); // Get the currently authenticated user
        // attach is only for many to many relationship
        // Attach the idea to the user's likes,
        // This attach method will create a new record in the idea_like table, associating the user and the idea.
        $liker->likes()->attach($idea);
        return redirect()->route('dashboard')->with('success', 'Liked successfully');
    }

    public function unlike(Request $request, $idea){
        $liker = auth()->user(); // Get the currently authenticated user
        $liker->likes()->detach($idea);
        return redirect()->route('dashboard')->with('success', 'Unliked successfully');
    }
}
