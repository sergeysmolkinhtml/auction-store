<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CreateLotRequest, UpdateLotRequest};
use App\Models\{Category, Lot, LotCategory};
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $lots = Lot::query()->categoriesId($request);
        $categories = Category::select('id','name')->get();
        return view('lots.index', compact('lots','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::select('id','name')->get();
        return view('lots.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLotRequest $request): RedirectResponse
    {
        $lot = Lot::create($request->validated());
        $categories = $request->input('categories');
        $lot->categories()->attach($categories);

        return redirect()->route('user.lots.show', $lot)
            ->with(['msg' => 'Successfully stored lot']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lot $lot): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $lot->load('categories');
        return view('lots.show', compact('lot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lot $lot): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::select('id','name')->get();
        $lot->load('categories');
        return view('lots.edit', compact('lot', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLotRequest $request,  Lot $lot): RedirectResponse
    {
        try {
            $lot->update($request->validated());
            $lot->categories()->syncWithoutDetaching($request->input('categories'));
        } catch (\Exception $e){
            return $e->getMessage();
        }

        return redirect()->route('user.lots.show', $lot)
            ->with(['msg' => 'Successfully updated lot']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lot $lot): RedirectResponse
    {
        $lot->delete();
        return redirect()->route('user.lots.index')
            ->with(['msg' => 'Successfully deleted lot']);
    }
}
