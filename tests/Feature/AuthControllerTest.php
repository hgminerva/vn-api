<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_should_get_authenticated_user_information()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->json('GET', 'api/auth')
            ->assertJsonStructure([
                'data' => ['id', 'name', 'email'],
            ]);
    }

    /** @test */
    public function it_should_update_authenticated_user_information()
    {
        $user = User::factory()->create();
        $data = ['name' => $this->faker->name, 'email' => $this->faker->safeEmail];

        $response = $this->actingAs($user)
            ->json('POST', 'api/auth', $data)
            ->assertJsonStructure([
                'data' => ['id', 'name', 'email'],
            ])
            ->assertJson([
                'data' => [
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]
            ]);
    }
}
