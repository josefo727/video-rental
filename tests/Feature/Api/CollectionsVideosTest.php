<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Video;
use App\Models\Collections;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionsVideosTest extends TestCase
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
    public function it_gets_collections_videos(): void
    {
        $collections = Collections::factory()->create();
        $video = Video::factory()->create();

        $collections->videos()->attach($video);

        $response = $this->getJson(
            route('api.all-collections.videos.index', $collections)
        );

        $response->assertOk()->assertSee($video->title);
    }

    /**
     * @test
     */
    public function it_can_attach_videos_to_collections(): void
    {
        $collections = Collections::factory()->create();
        $video = Video::factory()->create();

        $response = $this->postJson(
            route('api.all-collections.videos.store', [$collections, $video])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $collections
                ->videos()
                ->where('videos.id', $video->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_videos_from_collections(): void
    {
        $collections = Collections::factory()->create();
        $video = Video::factory()->create();

        $response = $this->deleteJson(
            route('api.all-collections.videos.store', [$collections, $video])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $collections
                ->videos()
                ->where('videos.id', $video->id)
                ->exists()
        );
    }
}
