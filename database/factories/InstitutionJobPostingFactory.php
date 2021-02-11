<?php

namespace Database\Factories;

use App\Models\Institution;
use App\Models\InstitutionJobPosting;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstitutionJobPostingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstitutionJobPosting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'institution_id' => Institution::factory(),
            'job_posting_date' => now(),
            'job_posting_expiry_date' => now()->addDay(),
            'job_title' => $this->faker->word(4, true),
            'job_type' => 'test',
            'description' => $this->faker->sentence,
            'work_location' => $this->faker->streetName,
            'keywords' => 'test',
            'enable' => $this->faker->randomElement([1, 0]),
            'required_skills' => 'test',
            'desired_skills_and_experience' => 'test',
        ];
    }
}
