<?php

namespace App\Http\Controllers;
use App\Models\Posting;
use App\Models\Comment;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()  {
        $posting = Posting::all();
        $comment = Comment::all();
        return view('main.index', compact('posting', 'comment'));
    }
}
