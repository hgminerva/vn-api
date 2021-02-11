<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_logout_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->json('POST', 'api/logout')
            ->assertNoContent();
    }
}
