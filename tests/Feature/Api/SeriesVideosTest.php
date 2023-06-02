<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Video;
use App\Models\Series;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesVideosTest extends TestCase
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
    public function it_gets_series_videos(): void
    {
        $series = Series::factory()->create();
        $videos = Video::factory()
            ->count(2)
            ->create([
                'series_id' => $series->id,
            ]);

        $response = $this->getJson(
            route('api.all-series.videos.index', $series)
        );

        $response->assertOk()->assertSee($videos[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_series_videos(): void
    {
        $series = Series::factory()->create();
        $data = Video::factory()
            ->make([
                'series_id' => $series->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.all-series.videos.store', $series),
            $data
        );

        $this->assertDatabaseHas('videos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $video = Video::latest('id')->first();

        $this->assertEquals($series->id, $video->series_id);
    }
}
