<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Series;

use App\Models\People;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesTest extends TestCase
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
    public function it_gets_all_series_list(): void
    {
        $allSeries = Series::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-series.index'));

        $response->assertOk()->assertSee($allSeries[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_series(): void
    {
        $data = Series::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-series.store'), $data);

        $this->assertDatabaseHas('series', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.all-series.update', $series),
            $data
        );

        $data['id'] = $series->id;

        $this->assertDatabaseHas('series', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_series(): void
    {
        $series = Series::factory()->create();

        $response = $this->deleteJson(route('api.all-series.destroy', $series));

        $this->assertModelMissing($series);

        $response->assertNoContent();
    }
}
