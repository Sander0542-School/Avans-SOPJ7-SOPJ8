<?php

namespace Database\Factories;

use App\Models\Layer;
use Illuminate\Database\Eloquent\Factories\Factory;

class LayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Layer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'content' => $this->faker->realText()
        ];
    }
}
