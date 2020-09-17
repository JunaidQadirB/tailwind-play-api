<?php

namespace Database\Factories;

use App\Models\Playground;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlaygroundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Playground::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => Str::random(10),
            'html' => $this->faker->word,
            'css' => $this->faker->word,
            'config' => $this->faker->word,
        ];
    }
}
