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

    public function destroy($id)
    {
        // Use ellquent
        $idea = Idea::where('id', $id)->firstOrFail();
        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }
}
