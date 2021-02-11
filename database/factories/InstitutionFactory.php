<?php

namespace Database\Factories;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstitutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Institution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'institution' => $this->faker->word(3, true),
            'postal_code' => $this->faker->postcode,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'enable' => $this->faker->randomElement([1, 0]),
            'user_id' => User::factory(),
            'remarks' => $this->faker->sentence,
        ];
    }
}
