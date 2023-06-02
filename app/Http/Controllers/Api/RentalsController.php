<?php

namespace App\Http\Controllers\Api;

use App\Models\Rentals;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RentalsResource;
use App\Http\Resources\RentalsCollection;
use App\Http\Requests\RentalsStoreRequest;
use App\Http\Requests\RentalsUpdateRequest;

class RentalsController extends Controller
{
    public function index(Request $request): RentalsCollection
    {
        $this->authorize('view-any', Rentals::class);

        $search = $request->get('search', '');

        $allRentals = Rentals::search($search)
            ->latest()
            ->paginate();

        return new RentalsCollection($allRentals);
    }

    public function store(RentalsStoreRequest $request): RentalsResource
    {
        $this->authorize('create', Rentals::class);

        $validated = $request->validated();

        $rentals = Rentals::create($validated);

        return new RentalsResource($rentals);
    }

    public function show(Request $request, Rentals $rentals): RentalsResource
    {
        $this->authorize('view', $rentals);

        return new RentalsResource($rentals);
    }

    public function update(
        RentalsUpdateRequest $request,
        Rentals $rentals
    ): RentalsResource {
        $this->authorize('update', $rentals);

        $validated = $request->validated();

        $rentals->update($validated);

        return new RentalsResource($rentals);
    }

    public function destroy(Request $request, Rentals $rentals): Response
    {
        $this->authorize('delete', $rentals);

        $rentals->delete();

        return response()->noContent();
    }
}
