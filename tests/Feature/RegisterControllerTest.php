<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_should_register_user()
    {
        $password = 'secret123';

        $response = $this->json('POST', 'api/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => $password,
            'password_confirmation' => $password,
        ])->assertCreated()
        ->assertJsonStructure(['data' => ['name', 'email'], 'token']);
    }
}
