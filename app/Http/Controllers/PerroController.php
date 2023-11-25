<?php
namespace App\Http\Controllers;

use App\Models\Perro;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'foto_url' => 'required|url',
                'descripcion' => 'nullable|string',
            ]);
    
            $perro = Perro::create($request->all());
    
            return response()->json(['message' => 'Perro creado con éxito'], 200);
        } catch (ValidationException $e) {
            // Manejar errores de validación
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'foto_url' => 'required|url',
            'descripcion' => 'nullable|string',
        ]);

        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        $perro->update($request->all());

        return response()->json(['message' => 'Perro actualizado'], 200);
    }

    // TODO
    // Cambiar por soft delete
    public function destroy($id)
    {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        $perro->delete();

        return response()->json(['message' => 'Perro eliminado'], 200);
    }
}
