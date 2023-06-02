<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RentalsResource;
use App\Http\Resources\RentalsCollection;

class UserAllRentalsController extends Controller
{
    public function index(Request $request, User $user): RentalsCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $allRentals = $user
            ->allRentals()
            ->search($search)
            ->latest()
            ->paginate();

        return new RentalsCollection($allRentals);
    }

    public function store(Request $request, User $user): RentalsResource
    {
        $this->authorize('create', Rentals::class);

        $validated = $request->validate([
            'video_id' => ['required', 'exists:videos,id'],
            'type' => ['required', 'max:255', 'string'],
            'total_value' => ['required', 'numeric'],
            'view_limit' => ['required', 'numeric'],
        ]);

        $rentals = $user->allRentals()->create($validated);

        return new RentalsResource($rentals);
    }
}
