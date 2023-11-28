<?php

namespace App\Http\Controllers;

use App\Models\Interaccion;
use Illuminate\Http\Request;
use App\Http\Requests\InteraccionRequest;

class InteraccionController extends Controller
{

    /**
     * Almacena una nueva interacción en la base de datos.
     *
     * @param  \App\Http\Requests\InteraccionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InteraccionRequest $request)
    {
        try {
            $data = $request->validated();
            $interaccion = Interaccion::create($data);

            // Comprobar si hay un match
            $match = Interaccion::where('perro_interesado_id', $data['perro_candidato_id'])
                ->where('perro_candidato_id', $data['perro_interesado_id'])
                ->where('preferencia', 'A')
                ->first();

            if ($match) {
                return response()->json(['message' => '¡Hay match!'], 200);
            } else {
                return response()->json(['message' => 'Ok'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Obtiene los perros que han sido aceptados por el perro con el ID dado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perrosAceptados($id)
    {
        $interacciones = Interaccion::where('perro_interesado_id', $id)
            ->where('preferencia', 'A')
            ->get();

        // Si está vacío, devolver un mensaje
        if ($interacciones->isEmpty()) {
            return response()->json(['message' => 'No hay perros aceptados'], 200);
        }

        return response()->json($interacciones);
    }

    /**
     * Obtiene los perros que han sido rechazados por el perro con el ID dado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perrosRechazados($id)
    {
        $interacciones = Interaccion::where('perro_interesado_id', $id)
            ->where('preferencia', 'R')
            ->get();
        // Si está vacío, devolver un mensaje
        if ($interacciones->isEmpty()) {
            return response()->json(['message' => 'No hay perros rechazados'], 200);
        }

        return response()->json($interacciones);
    }
}
