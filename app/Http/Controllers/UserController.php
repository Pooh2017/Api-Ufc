<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return response()->json(User::all()->toArray());
    }

    public function show(User $user) {
        return response()->json($user->toArray());
    }

    public function store(Request $request) {
        $user = User::create($request->except('foto'));

        if ($request->hasFile('foto')) {
            $user->updatePhoto($request->file('foto'));
        }

        return response()->json([
            'status' => 'User creado correctamente',
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user) {

        $user->forceFill($request->except('foto', '_method'));

        if ($request->hasFile('foto')) {
            $user->updatePhoto($request->file('foto'));
        }

        return response()->json([
            'status' => 'User editado correctamente',
            'user' => $user
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
