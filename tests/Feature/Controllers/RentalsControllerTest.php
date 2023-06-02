<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Rentals;

use App\Models\Video;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RentalsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_rentals(): void
    {
        $allRentals = Rentals::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-rentals.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_rentals.index')
            ->assertViewHas('allRentals');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_rentals(): void
    {
        $response = $this->get(route('all-rentals.create'));

        $response->assertOk()->assertViewIs('app.all_rentals.create');
    }

    /**
     * @test
     */
    public function it_stores_the_rentals(): void
    {
        $data = Rentals::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-rentals.store'), $data);

        $this->assertDatabaseHas('rentals', $data);

        $rentals = Rentals::latest('id')->first();

        $response->assertRedirect(route('all-rentals.edit', $rentals));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_rentals(): void
    {
        $rentals = Rentals::factory()->create();

        $response = $this->get(route('all-rentals.show', $rentals));

        $response
            ->assertOk()
            ->assertViewIs('app.all_rentals.show')
            ->assertViewHas('rentals');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_rentals(): void
    {
        $rentals = Rentals::factory()->create();

        $response = $this->get(route('all-rentals.edit', $rentals));

        $response
            ->assertOk()
            ->assertViewIs('app.all_rentals.edit')
            ->assertViewHas('rentals');
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

        $response = $this->put(route('all-rentals.update', $rentals), $data);

        $data['id'] = $rentals->id;

        $this->assertDatabaseHas('rentals', $data);

        $response->assertRedirect(route('all-rentals.edit', $rentals));
    }

    /**
     * @test
     */
    public function it_deletes_the_rentals(): void
    {
        $rentals = Rentals::factory()->create();

        $response = $this->delete(route('all-rentals.destroy', $rentals));

        $response->assertRedirect(route('all-rentals.index'));

        $this->assertModelMissing($rentals);
    }
}
