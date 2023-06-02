<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Video;

use App\Models\Series;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
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
    public function it_gets_videos_list(): void
    {
        $videos = Video::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.videos.index'));

        $response->assertOk()->assertSee($videos[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_video(): void
    {
        $data = Video::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.videos.store'), $data);

        $this->assertDatabaseHas('videos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_video(): void
    {
        $video = Video::factory()->create();

        $series = Series::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'attributes' => $this->faker->text(255),
            'original_language' => $this->faker->text(255),
            'classification' => $this->faker->text(255),
            'series_id' => $series->id,
        ];

        $response = $this->putJson(route('api.videos.update', $video), $data);

        $data['id'] = $video->id;

        $this->assertDatabaseHas('videos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_video(): void
    {
        $video = Video::factory()->create();

        $response = $this->deleteJson(route('api.videos.destroy', $video));

        $this->assertModelMissing($video);

        $response->assertNoContent();
    }
}
