<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Video;
use App\Models\Rentals;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoAllRentalsTest extends TestCase
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
    public function it_gets_video_all_rentals(): void
    {
        $video = Video::factory()->create();
        $allRentals = Rentals::factory()
            ->count(2)
            ->create([
                'video_id' => $video->id,
            ]);

        $response = $this->getJson(
            route('api.videos.all-rentals.index', $video)
        );

        $response->assertOk()->assertSee($allRentals[0]->type);
    }

    /**
     * @test
     */
    public function it_stores_the_video_all_rentals(): void
    {
        $video = Video::factory()->create();
        $data = Rentals::factory()
            ->make([
                'video_id' => $video->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.videos.all-rentals.store', $video),
            $data
        );

        $this->assertDatabaseHas('rentals', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $rentals = Rentals::latest('id')->first();

        $this->assertEquals($video->id, $rentals->video_id);
    }
}
