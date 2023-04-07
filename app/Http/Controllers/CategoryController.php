<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('categories.create');
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        return redirect()->route('user.categories.show', $category);
    }

    public function show(Category $category): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $category->load('lots');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {

        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('categories.show', $category);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
