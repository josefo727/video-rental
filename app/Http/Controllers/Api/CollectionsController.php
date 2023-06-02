<?php

namespace App\Http\Controllers\Api;

use App\Models\Collections;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionsResource;
use App\Http\Resources\CollectionsCollection;
use App\Http\Requests\CollectionsStoreRequest;
use App\Http\Requests\CollectionsUpdateRequest;

class CollectionsController extends Controller
{
    public function index(Request $request): CollectionsCollection
    {
        $this->authorize('view-any', Collections::class);

        $search = $request->get('search', '');

        $allCollections = Collections::search($search)
            ->latest()
            ->paginate();

        return new CollectionsCollection($allCollections);
    }

    public function store(CollectionsStoreRequest $request): CollectionsResource
    {
        $this->authorize('create', Collections::class);

        $validated = $request->validated();

        $collections = Collections::create($validated);

        return new CollectionsResource($collections);
    }

    public function show(
        Request $request,
        Collections $collections
    ): CollectionsResource {
        $this->authorize('view', $collections);

        return new CollectionsResource($collections);
    }

    public function update(
        CollectionsUpdateRequest $request,
        Collections $collections
    ): CollectionsResource {
        $this->authorize('update', $collections);

        $validated = $request->validated();

        $collections->update($validated);

        return new CollectionsResource($collections);
    }

    public function destroy(
        Request $request,
        Collections $collections
    ): Response {
        $this->authorize('delete', $collections);

        $collections->delete();

        return response()->noContent();
    }
}
