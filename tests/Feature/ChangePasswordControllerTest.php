<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangePasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_change_auth_user_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('secret123'),
        ]);

        $password = 'testing123';

        $this->actingAs($user)
            ->json('POST', 'api/change-password', [
                'password' => $password,
                'password_confirmation' => $password,
            ])
            ->assertNoContent();
    }
}
