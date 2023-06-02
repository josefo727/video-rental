<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Video;
use App\Models\Collections;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoAllCollectionsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_video_all_collections(): void
    {
        $video = Video::factory()->create();
        $collections = Collections::factory()->create();

        $video->allCollections()->attach($collections);

        $response = $this->getJson(
            route('api.videos.all-collections.index', $video)
        );

        $response->assertOk()->assertSee($collections->name);
    }

    /**
     * @test
     */
    public function it_can_attach_all_collections_to_video(): void
    {
        $video = Video::factory()->create();
        $collections = Collections::factory()->create();

        $response = $this->postJson(
            route('api.videos.all-collections.store', [$video, $collections])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $video
                ->allCollections()
                ->where('collections.id', $collections->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_all_collections_from_video(): void
    {
        $video = Video::factory()->create();
        $collections = Collections::factory()->create();

        $response = $this->deleteJson(
            route('api.videos.all-collections.store', [$video, $collections])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $video
                ->allCollections()
                ->where('collections.id', $collections->id)
                ->exists()
        );
    }
}
