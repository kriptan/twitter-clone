<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store()
    {
        // validations
        request()->validate([
            'idea' => 'required|min:5|max:240'
        ]);

        Idea::create([
            'content' => request()->get('idea', ''),
        ]);
        return redirect()->route('dashboard')->with('success', 'Idea created successfully');
    }

    public function destroy(Idea $idea)
    {
        // Use ellquent
        // $idea = Idea::where('id', $idea->firstOrFail();
        // $idea->delete();

        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }

    public function show(Idea $idea)
    {
        // return view('ideas.show', [
        //     'idea' => $idea
        // ]);

        return view('ideas.show', compact('idea'));
    }
}
