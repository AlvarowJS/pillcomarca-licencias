<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Administrado;
use App\Models\Negocio;
use App\Models\Subcategoria;

class NegocioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Negocio::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombrenegocio' => $this->faker->word(),
            'ruc' => $this->faker->word(),
            'direccion' => $this->faker->word(),
            'metroscuadrados' => $this->faker->word(),
            'monto' => $this->faker->word(),
            'nLicencia' => $this->faker->word(),
            'nExpediente' => $this->faker->word(),
            'fecha' => $this->faker->date(),
            'subcategoria_id' => Subcategoria::factory(),
            'administrado_id' => Administrado::factory(),
        ];
    }
}
