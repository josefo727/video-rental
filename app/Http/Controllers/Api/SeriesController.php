<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SeriesResource;
use App\Http\Resources\SeriesCollection;
use App\Http\Requests\SeriesStoreRequest;
use App\Http\Requests\SeriesUpdateRequest;

class SeriesController extends Controller
{
    public function index(Request $request): SeriesCollection
    {
        $this->authorize('view-any', Series::class);

        $search = $request->get('search', '');

        $allSeries = Series::search($search)
            ->latest()
            ->paginate();

        return new SeriesCollection($allSeries);
    }

    public function store(SeriesStoreRequest $request): SeriesResource
    {
        $this->authorize('create', Series::class);

        $validated = $request->validated();

        $series = Series::create($validated);

        return new SeriesResource($series);
    }

    public function show(Request $request, Series $series): SeriesResource
    {
        $this->authorize('view', $series);

        return new SeriesResource($series);
    }

    public function update(
        SeriesUpdateRequest $request,
        Series $series
    ): SeriesResource {
        $this->authorize('update', $series);

        $validated = $request->validated();

        $series->update($validated);

        return new SeriesResource($series);
    }

    public function destroy(Request $request, Series $series): Response
    {
        $this->authorize('delete', $series);

        $series->delete();

        return response()->noContent();
    }
}
