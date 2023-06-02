<?php

namespace Tests\Feature\Api;

use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUsersTest extends TestCase
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
    public function it_gets_user_users(): void
    {
        $user = User::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'referrer_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.users.index', $user));

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_users(): void
    {
        $user = User::factory()->create();
        $data = User::factory()
            ->make([
                'referrer_id' => $user->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.users.users.store', $user),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($user->id, $user->referrer_id);
    }
}
