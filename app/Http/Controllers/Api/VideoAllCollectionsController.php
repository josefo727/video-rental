<?php
namespace App\Http\Controllers\Api;

use App\Models\Video;
use App\Models\Collections;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CollectionsCollection;

class VideoAllCollectionsController extends Controller
{
    public function index(Request $request, Video $video): CollectionsCollection
    {
        $this->authorize('view', $video);

        $search = $request->get('search', '');

        $allCollections = $video
            ->allCollections()
            ->search($search)
            ->latest()
            ->paginate();

        return new CollectionsCollection($allCollections);
    }

    public function store(
        Request $request,
        Video $video,
        Collections $collections
    ): Response {
        $this->authorize('update', $video);

        $video->allCollections()->syncWithoutDetaching([$collections->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Video $video,
        Collections $collections
    ): Response {
        $this->authorize('update', $video);

        $video->allCollections()->detach($collections);

        return response()->noContent();
    }
}
