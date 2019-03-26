<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    Use WithFaker;

    /** @test */
    public function can_create_user_and_get_api_token()
    {
        $response = $this->postJson('/api/users');

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    "id",
                    "created_at",
                ],
                "meta" => [
                    'api_token'
                ]
            ]);

        $data = $response->decodeResponseJson()['data'];
        $this->assertDatabaseHas('users', [
            User::UUID => $data['id'],
            User::CREATED_AT => $data[User::CREATED_AT],
        ]);
    }

    /** @test */
    public function user_can_authenticate_with_api_token()
    {
        $response = $this->postJson('/api/users');

        $response->assertStatus(201);

        $token = $response->decodeResponseJson()['meta']['api_token'];

        $response = $this->getJson('/api/users/self', [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function self_endpoint_is_authenticated()
    {
        $response = $this->getJson('/api/users/self', [
            'Authorization' => 'Bearer notarealpassword'
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function user_can_delete_itself()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')
            ->deleteJson("/api/users/{$user->{User::UUID}}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', [
            User::UUID => $user->{User::UUID}
        ]);
    }

    /** @test */
    public function user_cannot_delete_someone_else()
    {
        $users = factory(User::class)->times(2)->create();

        $response = $this->actingAs($users[0], 'api')
            ->deleteJson("/api/users/{$users[1]->{User::UUID}}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('users', [
            User::UUID => $users[1]->{User::UUID}
        ]);
    }

    /** @test */
    public function user_can_view_itself()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')
            ->getJson("/api/users/{$user->{User::UUID}}");

        $response->assertStatus(200);

        $data = $response->decodeResponseJson()['data'];

        $this->assertSame($user->{User::UUID}, $data['id']);
    }

    /** @test */
    public function user_cannot_view_someone_else()
    {
        $users = factory(User::class)->times(2)->create();

        $response = $this->actingAs($users[0], 'api')
            ->getJson("/api/users/{$users[1]->{User::UUID}}");

        $response->assertStatus(403);
    }
}
