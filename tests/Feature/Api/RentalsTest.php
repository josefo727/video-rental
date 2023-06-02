<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Rentals;

use App\Models\Video;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RentalsTest extends TestCase
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
    public function it_gets_all_rentals_list(): void
    {
        $allRentals = Rentals::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-rentals.index'));

        $response->assertOk()->assertSee($allRentals[0]->type);
    }

    /**
     * @test
     */
    public function it_stores_the_rentals(): void
    {
        $data = Rentals::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-rentals.store'), $data);

        $this->assertDatabaseHas('rentals', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_rentals(): void
    {
        $rentals = Rentals::factory()->create();

        $user = User::factory()->create();
        $video = Video::factory()->create();

        $data = [
            'type' => $this->faker->word(),
            'total_value' => $this->faker->randomNumber(2),
            'view_limit' => $this->faker->randomNumber(0),
            'user_id' => $user->id,
            'video_id' => $video->id,
        ];

        $response = $this->putJson(
            route('api.all-rentals.update', $rentals),
            $data
        );

        $data['id'] = $rentals->id;

        $this->assertDatabaseHas('rentals', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_rentals(): void
    {
        $rentals = Rentals::factory()->create();

        $response = $this->deleteJson(
            route('api.all-rentals.destroy', $rentals)
        );

        $this->assertModelMissing($rentals);

        $response->assertNoContent();
    }
}
