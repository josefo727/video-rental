<?php

namespace App\Http\Controllers\Api;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoPersonResource;
use App\Http\Resources\VideoPersonCollection;

class VideoVideoPeopleController extends Controller
{
    public function index(Request $request, Video $video): VideoPersonCollection
    {
        $this->authorize('view', $video);

        $search = $request->get('search', '');

        $videoPeople = $video
            ->videoPeople()
            ->search($search)
            ->latest()
            ->paginate();

        return new VideoPersonCollection($videoPeople);
    }

    public function store(Request $request, Video $video): VideoPersonResource
    {
        $this->authorize('create', VideoPerson::class);

        $validated = $request->validate([
            'people_id' => ['required', 'exists:people,id'],
        ]);

        $videoPerson = $video->videoPeople()->create($validated);

        return new VideoPersonResource($videoPerson);
    }
}
