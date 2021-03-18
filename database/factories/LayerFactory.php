<?php

namespace Database\Factories;

use App\Models\Layer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->words(3, true);
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'content' => $this->faker->realText(20000),
            'slug' => $slug
        ];
    }
}
