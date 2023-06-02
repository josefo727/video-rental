<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Rentals;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAllRentalsTest extends TestCase
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
    public function it_gets_user_all_rentals(): void
    {
        $user = User::factory()->create();
        $allRentals = Rentals::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.all-rentals.index', $user));

        $response->assertOk()->assertSee($allRentals[0]->type);
    }

    /**
     * @test
     */
    public function it_stores_the_user_all_rentals(): void
    {
        $user = User::factory()->create();
        $data = Rentals::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.all-rentals.store', $user),
            $data
        );

        $this->assertDatabaseHas('rentals', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $rentals = Rentals::latest('id')->first();

        $this->assertEquals($user->id, $rentals->user_id);
    }
}
