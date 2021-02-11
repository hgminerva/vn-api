<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_get_list_of_users()
    {
        $users = User::factory(2)->create();

        $this->actingAs($users->first())
            ->json('GET', 'api/users')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'email'],
                ]
            ]);
    }
}
