<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {

        return view('categories.create');
    }

    public function store(Request $request)
    {

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();


        return redirect()->route('categories.show', $category);
    }

    public function show(Category $category)
    {
        $category->load('lots');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('categories.show', $category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
