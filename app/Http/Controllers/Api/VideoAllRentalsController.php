<?php

namespace App\Http\Controllers\Api;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RentalsResource;
use App\Http\Resources\RentalsCollection;

class VideoAllRentalsController extends Controller
{
    public function index(Request $request, Video $video): RentalsCollection
    {
        $this->authorize('view', $video);

        $search = $request->get('search', '');

        $allRentals = $video
            ->allRentals()
            ->search($search)
            ->latest()
            ->paginate();

        return new RentalsCollection($allRentals);
    }

    public function store(Request $request, Video $video): RentalsResource
    {
        $this->authorize('create', Rentals::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'type' => ['required', 'max:255', 'string'],
            'total_value' => ['required', 'numeric'],
            'view_limit' => ['required', 'numeric'],
        ]);

        $rentals = $video->allRentals()->create($validated);

        return new RentalsResource($rentals);
    }
}
