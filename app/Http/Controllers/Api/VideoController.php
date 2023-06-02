<?php

namespace App\Http\Controllers\Api;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Http\Resources\VideoCollection;
use App\Http\Requests\VideoStoreRequest;
use App\Http\Requests\VideoUpdateRequest;

class VideoController extends Controller
{
    public function index(Request $request): VideoCollection
    {
        $this->authorize('view-any', Video::class);

        $search = $request->get('search', '');

        $videos = Video::search($search)
            ->latest()
            ->paginate();

        return new VideoCollection($videos);
    }

    public function store(VideoStoreRequest $request): VideoResource
    {
        $this->authorize('create', Video::class);

        $validated = $request->validated();

        $video = Video::create($validated);

        return new VideoResource($video);
    }

    public function show(Request $request, Video $video): VideoResource
    {
        $this->authorize('view', $video);

        return new VideoResource($video);
    }

    public function update(
        VideoUpdateRequest $request,
        Video $video
    ): VideoResource {
        $this->authorize('update', $video);

        $validated = $request->validated();

        $video->update($validated);

        return new VideoResource($video);
    }

    public function destroy(Request $request, Video $video): Response
    {
        $this->authorize('delete', $video);

        $video->delete();

        return response()->noContent();
    }
}
