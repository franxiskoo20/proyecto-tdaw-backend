<?php

namespace App\Http\Controllers;

use App\Models\Interaccion;
use Illuminate\Http\Request;
use App\Http\Requests\InteraccionRequest;

class InteraccionController extends Controller
{
    public function index()
    {
        $interacciones = Interaccion::all();
        return response()->json($interacciones);
    }

    public function show($id)
    {
        $interaccion = Interaccion::find($id);

        if (!$interaccion) {
            return response()->json(['message' => 'Interacción no encontrada'], 404);
        }

        return response()->json($interaccion);
    }

    public function store(InteraccionRequest $request)
    {
        try {
            $interaccion = Interaccion::create($request->all());

            return response()->json(['message' => 'Interacción creada con éxito'], 200);
        } catch (\Exception $e) {
            // Manejar otros tipos de excepciones
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function update(InteraccionRequest $request, $id)
    {
        try {
            $interaccion = Interaccion::find($id);

            if (!$interaccion) {
                return response()->json(['message' => 'Interacción no encontrada'], 404);
            }

            $interaccion->update($request->all());

            return response()->json(['message' => 'Interacción actualizada'], 200);
        } catch (\Exception $e) {
            // Manejar otros tipos de excepciones
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function destroy($id)
    {
        $interaccion = Interaccion::find($id);

        if (!$interaccion) {
            return response()->json(['message' => 'Interacción no encontrada'], 404);
        }

        $interaccion->delete();

        return response()->json(['message' => 'Interacción eliminada'], 200);
    }
}
