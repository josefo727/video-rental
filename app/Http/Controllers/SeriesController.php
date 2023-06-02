<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\People;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SeriesStoreRequest;
use App\Http\Requests\SeriesUpdateRequest;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Series::class);

        $search = $request->get('search', '');

        $allSeries = Series::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_series.index', compact('allSeries', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Series::class);

        $allPeople = People::pluck('name', 'id');

        return view('app.all_series.create', compact('allPeople'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeriesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Series::class);

        $validated = $request->validated();

        $series = Series::create($validated);

        return redirect()
            ->route('all-series.edit', $series)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Series $series): View
    {
        $this->authorize('view', $series);

        return view('app.all_series.show', compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Series $series): View
    {
        $this->authorize('update', $series);

        $allPeople = People::pluck('name', 'id');

        return view('app.all_series.edit', compact('series', 'allPeople'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SeriesUpdateRequest $request,
        Series $series
    ): RedirectResponse {
        $this->authorize('update', $series);

        $validated = $request->validated();

        $series->update($validated);

        return redirect()
            ->route('all-series.edit', $series)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Series $series): RedirectResponse
    {
        $this->authorize('delete', $series);

        $series->delete();

        return redirect()
            ->route('all-series.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
