<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index-ca', compact('categories'),[
                "title" => "Data Category"
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.addData', [
            "title" => "Add Category"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|unique:categories,slug'
        ]);

        Category::create($validatedData);
        return redirect('/category')->with('sukses', 'Data has been stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Category::findOrFail($category->id);
        return view('Category.editCategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|unique:categories,slug,' . $category->id
        ]);

        $category->update($validatedData);

        return redirect('/category')->with('sukses', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/category')->with('success', 'Data has been deleted');
    }
}
