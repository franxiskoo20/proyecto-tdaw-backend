<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteraccionesTable extends Migration
{
    public function up()
    {
        Schema::create('interacciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perro_interesado_id');
            $table->unsignedBigInteger('perro_candidato_id');
            $table->enum('preferencia', ['aceptado', 'rechazado']);
            $table->timestamps();

            $table->foreign('perro_interesado_id')->references('id')->on('perros');
            $table->foreign('perro_candidato_id')->references('id')->on('perros');
        });
    }

    public function down()
    {
        Schema::dropIfExists('interacciones');
    }
}