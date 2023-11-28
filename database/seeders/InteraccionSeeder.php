<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interaccion;

class InteraccionSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 interacciones de prueba
        Interaccion::factory(10)->create();
    }
}
