<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index() {
        return response()->json(Vehiculo::latest()->get()->toArray());
    }

    public function show(Vehiculo $vehiculo) {
        return response()->json($vehiculo->toArray());
    }

    public function store(Request $request) {
        $vehiculo = Vehiculo::create($request->except('foto'));

        if ($request->hasFile('foto')) {
            $vehiculo->updatePhoto($request->file('foto'));
        }

        return response()->json([
            'status'   => 'Vehiculo creado correctamente',
            'vehiculo' => $vehiculo
        ]);
    }

    public function update(Request $request, Vehiculo $vehiculo) {

        $vehiculo->update($request->except('foto', '_method'));

        if ($request->hasFile('foto')) {
            $vehiculo->updatePhoto($request->file('foto'));
        }

        return response()->json([
            'status'   => 'Vehiculo editado correctamente',
            'vehiculo' => $vehiculo
        ]);
    }

    public function destroy(Vehiculo $vehiculo) {
        $vehiculo->deletePhoto();
        $vehiculo->delete();

        return response()->json([
            'status' => 'Vehiculo eliminado correctamente'
        ]);
    }
}
