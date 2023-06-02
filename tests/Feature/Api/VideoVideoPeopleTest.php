<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoPerson;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoVideoPeopleTest extends TestCase
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
    public function it_gets_video_video_people(): void
    {
        $video = Video::factory()->create();
        $videoPeople = VideoPerson::factory()
            ->count(2)
            ->create([
                'video_id' => $video->id,
            ]);

        $response = $this->getJson(
            route('api.videos.video-people.index', $video)
        );

        $response->assertOk()->assertSee($videoPeople[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_video_video_people(): void
    {
        $video = Video::factory()->create();
        $data = VideoPerson::factory()
            ->make([
                'video_id' => $video->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.videos.video-people.store', $video),
            $data
        );

        unset($data['video_id']);

        $this->assertDatabaseHas('video_people', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $videoPerson = VideoPerson::latest('id')->first();

        $this->assertEquals($video->id, $videoPerson->video_id);
    }
}
