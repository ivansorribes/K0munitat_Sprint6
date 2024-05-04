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
    
        // Obtener las solicitudes pendientes asociadas a esta comunidad
        $communityRequests = CommunityRequest::where('id_community', $communityId)
            ->where('status', 'pending')
            ->get();
    
        // Obtener la lista de usuarios asociados a esta comunidad con estado pendiente
        $users = [];
        foreach ($communityRequests as $request) {
            $users[] = User::find($request->id_user)->setAttribute('request_status', $request->status);
        }
    
        // Devolver la vista con la lista de usuarios y la comunidad
        return view('adminPanel.userCommunityRequest', compact('users', 'community'));
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

    public function acceptRequest($userId, $communityId)
    {
        try {
            // Buscar la solicitud pendiente del usuario para la comunidad específica
            $request = CommunityRequest::where('id_user', $userId)
                ->where('id_community', $communityId)
                ->where('status', 'pending')
                ->firstOrFail();
    
            // Actualizar el estado de la solicitud a "accepted"
            $request->status = 'accepted';
            $request->save();
    
            return redirect()->back()->with('success', 'Solicitud aceptada exitosamente.');
        } catch (\Exception $e) {
            // Manejar la excepción
            return redirect()->back()->with('error', 'Hubo un problema al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }
    }
    

public function denyRequest($requestId)
{
    // Buscar la solicitud por su ID
    $request = CommunityRequest::findOrFail($requestId);

    // Actualizar el estado de la solicitud a "denied"
    $request->status = 'denied';
    $request->save();

    return redirect()->back()->with('success', 'Solicitud denegada exitosamente.');
}

    


}
