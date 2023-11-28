<?php

namespace Database\Factories;

use App\Models\Interaccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class InteraccionFactory extends Factory
{
    protected $model = Interaccion::class;

    public function definition()
    {
        $perro_interesado_id = $this->faker->numberBetween(1, 20);
        $perro_candidato_id = $this->faker->numberBetween(1, 20);
    
        // Asegurarse de que los IDs no sean iguales
        while ($perro_interesado_id == $perro_candidato_id) {
            $perro_candidato_id = $this->faker->numberBetween(1, 20);
        }
    
        return [
            'perro_interesado_id' => $perro_interesado_id,
            'perro_candidato_id' => $perro_candidato_id,
            'preferencia' => $this->faker->randomElement(['A', 'R']),
        ];
    }
}
