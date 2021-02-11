<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_get_list_of_orders()
    {
        Order::factory(2)->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->json('GET', 'api/orders')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'order_number',
                        'customer_name',
                        'email',
                        'customer_address',
                        'product_code',
                        'result',
                    ],
                ]
            ]);
    }

    /** @test */
    public function it_should_get_the_specific_order()
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->json('GET', "api/orders/{$order->id}")
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'order_number',
                    'customer_name',
                    'email',
                    'customer_address',
                    'product_code',
                    'result',
                ]
            ]);
    }

    /** @test */
    public function it_should_create_order()
    {
        $payload = Order::factory()->make()->toArray();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->json('POST', "api/orders", $payload)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'order_number',
                    'customer_name',
                    'email',
                    'customer_address',
                    'product_code',
                    'result',
                ]
            ]);
    }

    /** @test */
    public function it_should_update_order()
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();

        $payload = Order::factory()->make()->toArray();

        $this->actingAs($user)
            ->json('PATCH', "api/orders/{$order->id}", $payload)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'order_number',
                    'customer_name',
                    'email',
                    'customer_address',
                    'product_code',
                    'result',
                ]
            ]);
    }

    /** @test */
    public function it_should_delete_order()
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->json('DELETE', "api/orders/{$order->id}")
            ->assertNoContent();

        $this->assertSoftDeleted('orders', [
            'id' => $order->id,
        ]);
    }
}
