<?php

namespace Database\Factories;

use App\Models\Interaccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class InteraccionFactory extends Factory
{
    protected $model = Interaccion::class;

    public function definition()
    {
        return [
            'perro_interesado_id' => $this->faker->numberBetween(1, 10), // Reemplaza con el rango correcto según tu modelo de datos
            'perro_candidato_id' => $this->faker->numberBetween(1, 10), // Reemplaza con el rango correcto según tu modelo de datos
            'preferencia' => $this->faker->randomElement(['aceptado', 'rechazado']),
        ];
    }
}
