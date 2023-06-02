<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Series;

use App\Models\People;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_series(): void
    {
        $allSeries = Series::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-series.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_series.index')
            ->assertViewHas('allSeries');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_series(): void
    {
        $response = $this->get(route('all-series.create'));

        $response->assertOk()->assertViewIs('app.all_series.create');
    }

    /**
     * @test
     */
    public function it_stores_the_series(): void
    {
        $data = Series::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-series.store'), $data);

        $this->assertDatabaseHas('series', $data);

        $series = Series::latest('id')->first();

        $response->assertRedirect(route('all-series.edit', $series));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_series(): void
    {
        $series = Series::factory()->create();

        $response = $this->get(route('all-series.show', $series));

        $response
            ->assertOk()
            ->assertViewIs('app.all_series.show')
            ->assertViewHas('series');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_series(): void
    {
        $series = Series::factory()->create();

        $response = $this->get(route('all-series.edit', $series));

        $response
            ->assertOk()
            ->assertViewIs('app.all_series.edit')
            ->assertViewHas('series');
    }

    /**
     * @test
     */
    public function it_updates_the_series(): void
    {
        $series = Series::factory()->create();

        $people = People::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'main_person_id' => $people->id,
        ];

        $response = $this->put(route('all-series.update', $series), $data);

        $data['id'] = $series->id;

        $this->assertDatabaseHas('series', $data);

        $response->assertRedirect(route('all-series.edit', $series));
    }

    /**
     * @test
     */
    public function it_deletes_the_series(): void
    {
        $series = Series::factory()->create();

        $response = $this->delete(route('all-series.destroy', $series));

        $response->assertRedirect(route('all-series.index'));

        $this->assertModelMissing($series);
    }
}
