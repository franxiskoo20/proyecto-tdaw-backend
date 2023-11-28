<?php

namespace App\Http\Controllers;

use App\Models\Perro;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\PerroRequest;
use App\Models\Interaccion;

class PerroController extends Controller
{
    public function index()
    {
        $perros = Perro::all();
        return response()->json($perros);
    }

    public function show($id)
    {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        return response()->json($perro);
    }

    public function store(PerroRequest $request)
    {
        try {
            $perro = Perro::create($request->all());

            return response()->json(['message' => 'Perro creado con éxito'], 200);
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    public function update(PerroRequest $request, $id)
    {
        try {
            $perro = Perro::find($id);

            if (!$perro) {
                return response()->json(['message' => 'Perro no encontrado'], 404);
            }

            $perro->update($request->all());

            return response()->json(['message' => 'Perro actualizado'], 200);
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    public function destroy($id)
    {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        $perro->delete();

        return response()->json(['message' => 'Perro eliminado'], 200);
    }

    public function perroRandom()
    {
        $perro = Perro::inRandomOrder()->first(['id', 'nombre']);

        if (!$perro) {
            return response()->json(['message' => 'No hay perros disponibles'], 404);
        }

        return response()->json($perro);
    }

    public function perrosCandidatos($perroInteresadoId)
    {
        // Obtener perros candidatos basados en la interacción aprobada
        $perrosCandidatos = Interaccion::where('perro_interesado_id', $perroInteresadoId)
            ->pluck('perro_candidato_id')
            ->toArray();

        // Obtener detalles de los perros candidatos
        $detallesPerrosCandidatos = Perro::whereIn('id', $perrosCandidatos)->get();

        return response()->json($detallesPerrosCandidatos);
    }
}
