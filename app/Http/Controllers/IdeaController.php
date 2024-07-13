<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store()
    {
        // validations
        $validated = request()->validate([
            'content' => 'required|min:5|max:240'
        ]);

        // Idea::create([
        //     'content' => request()->get('content', ''),
        // ]);

        // get logged in user uderlying the request
        $validated['user_id'] = auth()->id();
        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea created successfully');
    }

    public function destroy(Idea $idea)
    {
        // Use ellquent
        // $idea = Idea::where('id', $idea->firstOrFail();
        // $idea->delete();

        //only owner can delete
        if (auth()->id()!== $idea->user_id) {
            abort(404);
        }

        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }

    public function show(Idea $idea)
    {
        // return view('ideas.show', [
        //     'idea' => $idea
        // ]);

        // dd($idea->commnets);

        return view('ideas.show', compact('idea'));
    }


    public function edit(Idea $idea)
    {
        // Only owner can edit
        if (auth()->id()!== $idea->user_id) {
            abort(404);
        }
        
        $editing =true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        if (auth()->id()!== $idea->user_id) {
            abort(404);
        }
        $validated = request()->validate([
            'content' => 'required|min:5|max:240'
        ]);
        // $idea->content = request()->get('content', '');
        // $idea->save();

        $idea->update($validated);
       
        return redirect()->route('idea.show', $idea->id)->with('success', 'Idea update success');
    }
}
