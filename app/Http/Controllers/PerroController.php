<?php

namespace App\Http\Controllers;

use App\Models\Perro;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\PerroRequest;
use App\Models\Interaccion;

class PerroController extends Controller
{

    /**
     * Obtiene todos los perros de la base de datos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perros = Perro::all();
        return response()->json($perros);
    }

    /**
     * Almacena un nuevo perro en la base de datos.
     *
     * @param  \App\Http\Requests\PerroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerroRequest $request)
    {

        $perro = Perro::create($request->all());

        return response()->json(['message' => 'Perro creado con éxito'], 200);
    }

    /**
     * Obtiene los datos del perro con el ID dado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        return response()->json($perro);
    }

    /**
     * Actualiza los datos del perro con el ID dado.
     *
     * @param  \App\Http\Requests\PerroRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    /**
     * Elimina el perro con el ID dado de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perro = Perro::find($id);

        if (!$perro) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }

        $perro->delete();

        return response()->json(['message' => 'Perro eliminado'], 200);
    }

    /**
     * Obtiene un perro al azar de la base de datos.
     *
     * @return \Illuminate\Http\Response
     */
    public function perroRandom()
    {
        $perro = Perro::inRandomOrder()->first(['id', 'nombre']);

        if (!$perro) {
            return response()->json(['message' => 'No hay perros disponibles'], 404);
        }

        return response()->json($perro);
    }

    /**
     * Obtiene un perro al azar de la base de datos que no sea el perro con el ID dado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perrosCandidatos($perroInteresadoId)
    {
        $perroCandidato = Perro::where('id', '!=', $perroInteresadoId)
            ->inRandomOrder()
            ->first(['foto_url', 'nombre', 'descripcion']);

        if (!$perroCandidato) {
            return response()->json(['message' => 'No hay otros perros disponibles'], 404);
        }

        return response()->json($perroCandidato);
    }
}
