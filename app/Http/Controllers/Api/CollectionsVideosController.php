<?php
namespace App\Http\Controllers\Api;

use App\Models\Video;
use App\Models\Collections;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoCollection;

class CollectionsVideosController extends Controller
{
    public function index(
        Request $request,
        Collections $collections
    ): VideoCollection {
        $this->authorize('view', $collections);

        $search = $request->get('search', '');

        $videos = $collections
            ->videos()
            ->search($search)
            ->latest()
            ->paginate();

        return new VideoCollection($videos);
    }

    public function store(
        Request $request,
        Collections $collections,
        Video $video
    ): Response {
        $this->authorize('update', $collections);

        $collections->videos()->syncWithoutDetaching([$video->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Collections $collections,
        Video $video
    ): Response {
        $this->authorize('update', $collections);

        $collections->videos()->detach($video);

        return response()->noContent();
    }
}
