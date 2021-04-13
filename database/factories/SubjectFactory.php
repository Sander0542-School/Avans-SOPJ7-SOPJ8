<?php

namespace Database\Factories;

use App\Models\Domain;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $domain = Domain::create([
            'id' => 1,
            'name' => 'Gebied 1',
            'color' => '15941f'
        ]);

        $name = $this->faker->words(3, true);

        return [
            'name' => $name,
            'id' => 1,
            'domain_id' => $domain->id,
            'lat' => 52.113462,
            'lon' => 6.611401,
            'order' => 1
        ];
    }
}
