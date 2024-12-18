<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index() {
        return response()->json(User::latest()->get()->toArray());
    }

    public function show(User $user) {
        return response()->json($user->toArray());
    }

    public function store(Request $request) {
        /*
         // Validación para la imagen
         $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'foto' => 'nullable|string',
        ]);

        // Crear el usuario sin el campo foto
        $user = User::create($request->except('foto'));

        // Verificar si se cargó una foto
        if ($request->hasFile('foto')) {
            // Generar el nombre del archivo
            $photoName = time() . '.' . $request->foto->extension();

            // Solo guardar el nombre del archivo en la base de datos
            $user->update(['photo' => $photoName]);
        }

        return response()->json([
            'status' => 'User creado correctamente',
            'user'   => $user
        ]);
        */


        $user = User::create($request->except('foto'));

        if ($request->hasFile('foto')) {
            $user->updatePhoto($request->file('foto'));
        }

        return response()->json([
            'status' => 'User creado correctamente',
            'user'   => $user
        ]);

    }

    public function update(Request $request, User $user) {
        /*
                // Validación
                $request->validate([
                    'name' => 'nullable|string',
                    'email' => 'nullable|email|unique:users,email,' . $user->id,
                    'password' => 'nullable|string|min:6',
                    'foto' => 'nullable|string',
                ]);

                // Actualizar el usuario sin el campo foto
                $user->update($request->except('foto', '_method'));

                // Si se cargó una nueva foto, solo almacenar el nombre del archivo
                if ($request->hasFile('foto')) {
                    // Generar el nombre del archivo
                    $photoName = time() . '.' . $request->foto->extension();

                    // Guardar solo el nombre del archivo en la base de datos
                    $user->update(['photo' => $photoName]);
                }

                return response()->json([
                    'status' => 'User editado correctamente',
                    'user'   => $user
                ]);
*/

        $user->update($request->except('foto', "_method"));

        if ($request->hasFile('foto')) {
            $user->updatePhoto($request->file('foto'));
        }

        return response()->json([
            'status' => 'User editado correctamente',
            'user'   => $user
        ]);

    }

    public function destroy(User $user) {
        $user->deletePhoto();
        $user->delete();

        return response()->json([
            'status' => 'User eliminado correctamente'
        ]);
    }
}
