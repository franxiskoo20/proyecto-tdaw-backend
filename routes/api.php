<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerroController;
use App\Http\Controllers\InteraccionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('perros')->group(function () {

    Route::get('/random', [PerroController::class, 'perroRandom'])->name('perros.random');
    Route::get('/candidatos/{perroInteresadoId}', [PerroController::class, 'perrosCandidatos'])->name('perros.candidatos');

    //Interacciones
    Route::post('/interacciones', [InteraccionController::class, 'store']);

    Route::get('/{id}/aceptados', [InteraccionController::class, 'perrosAceptados'])->name('perros.aceptados');
    Route::get('/{id}/rechazados', [InteraccionController::class, 'perrosRechazados'])->name('perros.rechazados');

    //CRUD Perros
    Route::get('/', [PerroController::class, 'index'])->name('perros.index');
    Route::get('/{id}', [PerroController::class, 'show'])->name('perros.show');
    Route::post('/', [PerroController::class, 'store'])->name('perros.store');
    Route::put('/{id}', [PerroController::class, 'update'])->name('perros.update');
    Route::delete('/{id}', [PerroController::class, 'destroy'])->name('perros.destroy');
});

/*  DOCUMENTACIÓN DE LA API

1) Obtener un Perro Aleatorio:
    URL: http://localhost:8000/api/perros/random
    Método: GET

2) Obtener Perros Candidatos:
    URL: http://localhost:8000/api/perros/candidatos/{perroInteresadoId}
    Método: GET

3) Guardar Preferencia de Interacción:
    URL: http://localhost:8000/api/perros/interacciones
    Método: POST

4) Obtener perros rechazados con el id de un perro interesado:
    URL: http://localhost:8000/api/perros/{id}/rechazados
    Método: GET

5) Obtener perros aceptados con el id de un perro interesado:
    URL: http://localhost:8000/api/perros/{id}/aceptados
    Método: GET

6)Operaciones CRUD para Perros:

    Listar todos los perros:
    URL: http://localhost:8000/api/perros/
    Método: GET
    
    Crear un nuevo perro:
    URL: http://localhost:8000/api/perros/
    Método: POST

    Mostrar un perro específico:
    URL: http://localhost:8000/api/perros/{id}
    Método: GET

    Actualizar un perro específico:
    URL: http://localhost:8000/api/perros/{id}
    Método: PUT/PATCH

    Eliminar un perro específico:
    URL: http://localhost:8000/api/perros/{id}
    Método: DELETE

 */
