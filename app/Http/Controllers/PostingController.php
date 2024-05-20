<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostingRequest;
use App\Http\Requests\UpdatePostingRequest;

class PostingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posting = Posting::all();
        return view('post/posts', compact('posting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post/addPost', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostingRequest $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:225',
            'slug' => 'required|unique:posts',
            'body' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $bodyText = strip_tags($request->input('body'));
        $validatedData['excerpt'] = Str::limit($bodyText, 50, '...');

        Posting::create($validatedData);
        return redirect('/posts')->with('sukses', 'Post has been uploaded!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Posting $posting)
    {
        $comments = Comment::where('post_id', $posting->id)->get();
        return view('post/show', compact('posting', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posting $posting)
    {
        $categories = Category::all();
        return view('post.formEdit', compact('posting', 'categories'), [
            'post' => 'posting'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostingRequest $request, Posting $posting)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:225',
            'slug' => 'required|unique:posts,slug,' . $posting->id,
            'body' => 'required'
        ]);
    
        $validatedData['excerpt'] = Str::limit(strip_tags($request->input('body')), 50, '...');
    
        $posting->update($validatedData);
    
        return redirect('/posts')->with('sukses', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posting $posting)
    {
        $posting->delete();
    
        return redirect('/posts')->with('sukses', 'Post has been deleted!');
    }
}
