<?php

namespace Database\Factories;

use App\Models\Domain;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'domain_id' => Domain::inRandomOrder()->first()->id,
            'lat' => ($this->faker->numberBetween(52108672, 52120610) / 1000000),
            'lon' => ($this->faker->numberBetween(6573487, 6614364) / 1000000),
            'order' => 1
        ];
    }
}
