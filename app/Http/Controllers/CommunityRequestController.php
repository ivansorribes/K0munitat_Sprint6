<?php

namespace App\Http\Controllers;

use App\Models\CommunityRequest;
use Illuminate\Http\Request;

class CommunityRequestController extends Controller
{
    public function store(Request $request)
    {
        // Valida los datos de entrada
        $request->validate([
            'id_community' => 'required|numeric',
            'id_user' => 'required|numeric'
        ]);

        // Crea un nuevo objeto CommunityRequest con los datos proporcionados
        $communityRequest = CommunityRequest::create([
            'id_community' => $request->id_community,
            'id_user' => $request->id_user,
            'status' => 'pending' // Asigna el estado como "pending" por defecto
        ]);

        $communityRequest->save();

        // Retorna una respuesta adecuada
        return response()->json([
            'message' => 'Successfully created community application.',
            'data' => $communityRequest
        ], 201);
    }
}
