<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Models\Rentals;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RentalsStoreRequest;
use App\Http\Requests\RentalsUpdateRequest;

class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Rentals::class);

        $search = $request->get('search', '');

        $allRentals = Rentals::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_rentals.index', compact('allRentals', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Rentals::class);

        $users = User::pluck('name', 'id');
        $videos = Video::pluck('title', 'id');

        return view('app.all_rentals.create', compact('users', 'videos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RentalsStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Rentals::class);

        $validated = $request->validated();

        $rentals = Rentals::create($validated);

        return redirect()
            ->route('all-rentals.edit', $rentals)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Rentals $rentals): View
    {
        $this->authorize('view', $rentals);

        return view('app.all_rentals.show', compact('rentals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Rentals $rentals): View
    {
        $this->authorize('update', $rentals);

        $users = User::pluck('name', 'id');
        $videos = Video::pluck('title', 'id');

        return view(
            'app.all_rentals.edit',
            compact('rentals', 'users', 'videos')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RentalsUpdateRequest $request,
        Rentals $rentals
    ): RedirectResponse {
        $this->authorize('update', $rentals);

        $validated = $request->validated();

        $rentals->update($validated);

        return redirect()
            ->route('all-rentals.edit', $rentals)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Rentals $rentals
    ): RedirectResponse {
        $this->authorize('delete', $rentals);

        $rentals->delete();

        return redirect()
            ->route('all-rentals.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
