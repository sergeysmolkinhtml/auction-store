<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    CreateCategoryRequest,
    UpdateCategoryRequest
};

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;


class CategoryController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::paginate(20);

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

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('user.categories.show', $category);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('user.categories.index');
    }
}
