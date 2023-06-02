<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Collections;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CollectionsStoreRequest;
use App\Http\Requests\CollectionsUpdateRequest;

class CollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Collections::class);

        $search = $request->get('search', '');

        $allCollections = Collections::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_collections.index',
            compact('allCollections', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Collections::class);

        return view('app.all_collections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollectionsStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Collections::class);

        $validated = $request->validated();

        $collections = Collections::create($validated);

        return redirect()
            ->route('all-collections.edit', $collections)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Collections $collections): View
    {
        $this->authorize('view', $collections);

        return view('app.all_collections.show', compact('collections'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Collections $collections): View
    {
        $this->authorize('update', $collections);

        return view('app.all_collections.edit', compact('collections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CollectionsUpdateRequest $request,
        Collections $collections
    ): RedirectResponse {
        $this->authorize('update', $collections);

        $validated = $request->validated();

        $collections->update($validated);

        return redirect()
            ->route('all-collections.edit', $collections)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Collections $collections
    ): RedirectResponse {
        $this->authorize('delete', $collections);

        $collections->delete();

        return redirect()
            ->route('all-collections.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
