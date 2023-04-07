<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLotRequest;
use App\Models\Category;
use App\Models\Lot;
use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = Lot::query();

        // category filter
        if ($request->has('categories')) {
            $categories = explode(',', $request->get('categories'));
            $query->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('id', $categories);
            });
        }

        $lots = $query->paginate(10);
        return view('lots.index', compact('lots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();

        return view('lots.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lot = new Lot();
        $lot->title = $request->input('title');
        $lot->description = $request->input('description');
        $lot->save();


        $categories = $request->input('categories');

        $lot->categories()->attach($categories);

        return redirect()->route('user.lots.show', $lot);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lot $lot)
    {

        $lot->load('categories');

        return view('lots.show', compact('lot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lot $lot)
    {
        $categories = Category::all();

        $lot->load('categories');

        return view('lots.edit', compact('lot', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Lot $lot)
    {
        $lot->name = $request->input('name');
        $lot->description = $request->input('description');
        $lot->save();

        $categories = $request->input('categories');
        $lot->categories()->sync($categories);


        return redirect()->route('lots.show', $lot);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lot $lot)
    {
        $lot->delete();
    }
}
