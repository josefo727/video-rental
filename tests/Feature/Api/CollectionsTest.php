<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Collections;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionsTest extends TestCase
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
    public function it_gets_all_collections_list(): void
    {
        $allCollections = Collections::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-collections.index'));

        $response->assertOk()->assertSee($allCollections[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_collections(): void
    {
        $data = Collections::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-collections.store'), $data);

        $this->assertDatabaseHas('collections', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_collections(): void
    {
        $collections = Collections::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.all-collections.update', $collections),
            $data
        );

        $data['id'] = $collections->id;

        $this->assertDatabaseHas('collections', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_collections(): void
    {
        $collections = Collections::factory()->create();

        $response = $this->deleteJson(
            route('api.all-collections.destroy', $collections)
        );

        $this->assertModelMissing($collections);

        $response->assertNoContent();
    }
}
