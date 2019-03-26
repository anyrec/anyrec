<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Recommendation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateRecommendationTest extends TestCase
{
    use RefreshDatabase;
    Use WithFaker;

    /** @test */
    public function user_can_request_an_recommendation()
    {
        $user = factory(User::class)->create();

        $title = $this->faker->text;

        $response = $this->actingAs($user, 'api')
            ->postJson("/api/recommendation", [
                'title' => $title
            ]);

        $response->assertStatus(201);

        $this->assertSame($title, Recommendation::first()->request['title']);
    }
}
