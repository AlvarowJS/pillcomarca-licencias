<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Administrado;

class AdministradoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Administrado::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombreadministrado' => $this->faker->word(),
            'apellidoadministrado' => $this->faker->word(),
            'numero' => $this->faker->word(),
            'dni' => $this->faker->word(),
            'ruc' => $this->faker->word(),
            'gmail' => $this->faker->word(),
        ];
    }
}
