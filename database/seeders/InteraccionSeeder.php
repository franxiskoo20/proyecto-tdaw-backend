<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interaccion;

class InteraccionSeeder extends Seeder
{
    public function run()
    {
        // Usar el factory para crear 20 interacciones de ejemplo
        Interaccion::factory(20)->create();
    }
}
