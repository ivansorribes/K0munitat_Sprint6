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

    public function showUsers($communityId)
    {
        // Obtener la comunidad por su ID
        $community = CommunityRequest::findOrFail($communityId);

        // Obtener la lista de usuarios asociados a esta comunidad
        $users = $community->communityUsers()->get();

        // Devolver la vista con la lista de usuarios
        return view('adminPanel.usuarisComunitat', compact('users', 'community'));
    }

    public function showRequestCommunities()
    {
        $communityRequests = CommunityRequest::getPendingRequests();


        return view('adminPanel.paneladminCommunitiesRequest', compact('communityRequests'));
    }

}
