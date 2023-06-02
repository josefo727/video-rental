<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Collections;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionsControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_collections(): void
    {
        $allCollections = Collections::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-collections.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_collections.index')
            ->assertViewHas('allCollections');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_collections(): void
    {
        $response = $this->get(route('all-collections.create'));

        $response->assertOk()->assertViewIs('app.all_collections.create');
    }

    /**
     * @test
     */
    public function it_stores_the_collections(): void
    {
        $data = Collections::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-collections.store'), $data);

        $this->assertDatabaseHas('collections', $data);

        $collections = Collections::latest('id')->first();

        $response->assertRedirect(route('all-collections.edit', $collections));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_collections(): void
    {
        $collections = Collections::factory()->create();

        $response = $this->get(route('all-collections.show', $collections));

        $response
            ->assertOk()
            ->assertViewIs('app.all_collections.show')
            ->assertViewHas('collections');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_collections(): void
    {
        $collections = Collections::factory()->create();

        $response = $this->get(route('all-collections.edit', $collections));

        $response
            ->assertOk()
            ->assertViewIs('app.all_collections.edit')
            ->assertViewHas('collections');
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

        $response = $this->put(
            route('all-collections.update', $collections),
            $data
        );

        $data['id'] = $collections->id;

        $this->assertDatabaseHas('collections', $data);

        $response->assertRedirect(route('all-collections.edit', $collections));
    }

    /**
     * @test
     */
    public function it_deletes_the_collections(): void
    {
        $collections = Collections::factory()->create();

        $response = $this->delete(
            route('all-collections.destroy', $collections)
        );

        $response->assertRedirect(route('all-collections.index'));

        $this->assertModelMissing($collections);
    }
}
