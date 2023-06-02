<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Http\Resources\VideoCollection;

class SeriesVideosController extends Controller
{
    public function index(Request $request, Series $series): VideoCollection
    {
        $this->authorize('view', $series);

        $search = $request->get('search', '');

        $videos = $series
            ->videos()
            ->search($search)
            ->latest()
            ->paginate();

        return new VideoCollection($videos);
    }

    public function store(Request $request, Series $series): VideoResource
    {
        $this->authorize('create', Video::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'attributes' => ['required', 'max:255', 'string'],
            'original_language' => ['required', 'max:255', 'string'],
            'classification' => ['required', 'max:255', 'string'],
        ]);

        $video = $series->videos()->create($validated);

        return new VideoResource($video);
    }
}
