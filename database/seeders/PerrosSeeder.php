<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perro;

class PerrosSeeder extends Seeder
{
    public function run()
    {
        // Usar el factory para crear 20 perros de ejemplo
        Perro::factory(20)->create();
    }
}