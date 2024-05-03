<?php

namespace App\Http\Controllers;

use App\Models\CommunityRequest;
use App\Models\communities;
use App\Models\communitiesUsers;
use App\Models\User;
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

    public function showUsersRequest($communityId)
    {
        // Obtener la comunidad por su ID
        $community = communities::findOrFail($communityId);

        // Obtener los IDs de las solicitudes pendientes asociadas a esta comunidad
        $pendingRequestIds = CommunityRequest::where('id_community', $communityId)
            ->where('status', 'pending')
            ->pluck('id_user');

        // Obtener la lista de usuarios asociados a esta comunidad con estado pendiente
        $users = User::whereIn('id', $pendingRequestIds)->get();

        // Devolver la vista con la lista de usuarios
        return view('adminPanel.usuarisComunitat', compact('users', 'community'));
    }

    public function showRequestCommunities()
    {
        $communityRequests = CommunityRequest::getPendingRequests();

        // Obtener el estado de cada comunidad y agregarlo al conjunto de datos
        foreach ($communityRequests as $request) {
            $isActive = $request->community->isActive ? 'Activa' : 'Inactiva';
            $request->setAttribute('isActive', $isActive);
        }


        return view('adminPanel.paneladminCommunitiesRequest', compact('communityRequests'));
    }

}
