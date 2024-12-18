<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fighter;

class FighterController extends Controller
{
        // Obtener todos los peleadores
        public function index()
        {
            return Fighter::all();
        }

        // Crear un nuevo peleador
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'nickname' => 'required|string|max:255',
                'division' => 'required|string|max:255',
                'wins' => 'required|integer|min:0',
                'losses' => 'required|integer|min:0',
                'knockouts' => 'required|integer|min:0',
                'submissions' => 'required|integer|min:0',
                'gender' => 'required|in:Masculino,Femenino',
                'image' => 'nullable|string',
            ]);

            return Fighter::create($validated);
        }

        // Obtener un peleador por ID
        public function show($id)
        {
            return Fighter::findOrFail($id);
        }

        // Actualizar un peleador
        public function update(Request $request, $id)
        {
            $fighter = Fighter::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'nickname' => 'sometimes|string|max:255',
                'division' => 'sometimes|string|max:255',
                'wins' => 'sometimes|integer|min:0',
                'losses' => 'sometimes|integer|min:0',
                'knockouts' => 'sometimes|integer|min:0',
                'submissions' => 'sometimes|integer|min:0',
                'gender' => 'sometimes|in:Masculino,Femenino',
                'image' => 'nullable|string',
            ]);

            $fighter->update($validated);

            return $fighter;
        }


        // Eliminar un peleador
        public function destroy($id)
        {
            $fighter = Fighter::findOrFail($id);
            $fighter->delete();

            return response()->json(['message' => 'Fighter deleted successfully']);
        }
}
