<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perro;

class PerrosSeeder extends Seeder
{
    public function run()
    {
        // Usar el factory para crear 10 perros de ejemplo
        Perro::factory(10)->create();
    }
}