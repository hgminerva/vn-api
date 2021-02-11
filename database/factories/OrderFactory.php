<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number' => $this->faker->randomNumber(3),
            'product_code' => $this->faker->randomNumber(2),
            'customer_name' => $this->faker->name,
            'customer_address' => $this->faker->streetAddress,
            'email' => $this->faker->unique()->safeEmail,
            'result' => $this->faker->boolean,
        ];
    }
}
