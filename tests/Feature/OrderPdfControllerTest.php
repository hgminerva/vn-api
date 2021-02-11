<?php

namespace Tests\Feature;

use App\Mail\SendPdfToCustomer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OrderPdfControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_send_order_to_email()
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();

        Mail::fake();

        $response = $this->actingAs($user)
            ->json('GET', "api/order-pdf/mail/{$order->id}")
            ->assertOk()
            ->assertJsonStructure(['status']);

        Mail::assertSent(function (SendPdfToCustomer $mail) use ($order) {
            return $mail->order->id === $order->id;
        });
    }

    /** @test */
    public function it_should_export_order_to_pdf()
    {
        $order = Order::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->json('GET', "api/order-pdf/export/{$order->id}")
            ->assertOk();
    }
}
