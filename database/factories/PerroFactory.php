<?php

namespace Database\Factories;

use App\Models\Perro;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerroFactory extends Factory
{
    protected $model = Perro::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'foto_url' => $this->faker->imageUrl(),
            'descripcion' => $this->faker->paragraph,
        ];
    }
}