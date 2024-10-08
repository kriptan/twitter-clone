<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = Idea::orderBy('created_at', 'DESC');
        // $ideas = Idea::without('user','comments')->orderBy('created_at', 'DESC');

        if (request()->has('search')) {
            $ideas = $ideas->where('content', 'LIKE', '%'.request()->get('search', '').'%');
        }
        
        return view('dashboard', [
            'ideas' =>  $ideas->paginate('5')
        ]);
    }
}
