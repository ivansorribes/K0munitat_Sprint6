<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function LoginView()
    {
        return view('login.login');
    }

    public function ProfileView()
    {
        $user = auth()->user();
        return view('profile.personalProfile', compact('user'));
    }

    public function updateProfileDescription(Request $request)
{
    try {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Actualiza la descripción del usuario con la nueva descripción proporcionada en la solicitud
        $affectedRows = DB::table('users')
            ->where('id', $user->id)
            ->update(['profile_description' => $request->input('description')]);

        if ($affectedRows > 0) {
            return response()->json(['message' => 'Descripción actualizada con éxito'], 200);
        } else {
            return response()->json(['error' => 'Error al actualizar la descripción'], 500);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al actualizar la descripción'], 500);
    }
}

public function postUser()
{
    $user = auth()->user();
    return view('profile.personalProfile', compact('user'));
}

}
