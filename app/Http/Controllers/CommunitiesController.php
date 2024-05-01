<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\communities;
use App\Models\communitiesUsers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunitiesController extends Controller
{

    public function retornarComunitats()
    {
        // Obtener todas las comunidades con los usuarios asociados
        $communities = communities::with('admin')->get();
        return view('adminPanel.paneladminComunitats', compact('communities'));
    }



    public function stateChange($id)
    {
        $community = communities::findOrFail($id);
        $community->isActive = !$community->isActive;
        $community->save();

        return redirect()->back()->with('success', 'Estado cambiado exitosamente');
    }

    public function showUsers($communityId)
    {
        // Obtener la comunidad por su ID
        $community = communities::findOrFail($communityId);

        // Obtener la lista de usuarios asociados a esta comunidad
        $users = $community->communityUsers()->get();

        // Devolver la vista con la lista de usuarios
        return view('adminPanel.usuarisComunitat', compact('users', 'community'));
    }
    public function create()
    {
        return view('communities.createForm');
    }

    public function index()
    {
        return view('communities.CommunitiesList');
    }

    public function store(Request $request)
    {
        try {
            // Validación de datos para la comunidad
            $validatedData = $request->validate([
                'name' => 'required|string|max:254',
                'description' => 'required|string|max:254',
                'id_autonomousCommunity' => 'required',
                'id_region' => 'required',
                'private' => 'required|boolean',
                'id_admin' => 'required'
            ]);
    
            // Escapar los datos antes de almacenarlos en la base de datos
            $validatedData['name'] = htmlspecialchars($validatedData['name']);
            $validatedData['description'] = htmlspecialchars($validatedData['description']);
    
            // Crear la comunidad
            $community = communities::create($validatedData);
    
            // Crear la entrada en communitiesUsers para asociar al usuario con la nueva comunidad
            $userCommunity = communitiesUsers::create([
                'id_community' => $community->id,
                'id_user' => $validatedData['id_admin']
            ]);
    
            // Redirigir de vuelta al formulario después de la presentación
            return response()->json(['message' => 'Community created successfully']);
        } catch (ValidationException $e) {
            // Captura de errores de validación
            return redirect()->route('communities.create')->withErrors($e->errors());
        }
    }

    public function show($id)
    {
        // Obtén la comunidad por ID
        $community = Communities::find($id);

        if (!$community) {
            abort(404); // O devuelve una vista de error
        }

        return view('communities.show', ['community' => $community]);
    }

    public function edit($id)
    {
        $community = communities::find($id);

        if (!$community) {
            return response()->json(['message' => 'Community not found'], 404);
        }

        return view('communities.edit', ['community' => $community]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validación de datos
            $validatedData = $request->validate([
                'name' => 'required|string|max:254',
                'description' => 'required|string|max:254',
                'id_autonomousCommunity' => 'required',
                'id_region' => 'required',
                'private' => 'required|boolean',
                'id_admin' => 'required'
            ]);

            // Actualizar la comunidad
            $community = communities::find($id);

            if (!$community) {
                return response()->json(['message' => 'Community not found'], 404);
            }

            $community->update($validatedData);

            return response()->json(['message' => 'Community updated successfully']);
        } catch (\Exception $e) {
            // Captura de errores
            return response()->json(['message' => 'Error updating community', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $communities = communities::destroy($id);
        return $communities;
    }

    public function communitiesUser() 
    {
        $user = Auth::user();
        $communitiesUser = $user->communities;

        $hasCommunities = !$communitiesUser->isEmpty();
        
        return response()->json([
            'hasCommunities' => $hasCommunities,
            'communities' => $communitiesUser,
            'user' => $user
        ]); 
    }

    

    public function communitiesOpen() 
    {
        $communitiesOpen = communities::where('private', 0)->get();
        return $communitiesOpen;
    }

    public function isMember ($idUser) {
        $isMember = communitiesUsers::where('id_user', $idUser);
        return $isMember;
    }

    public function communitiesList(Request $request) 
    {
        $user = Auth::user();
        // Obtener el número de página de la solicitud
        $page = $request->input('page', 1);
            
        // Definir la cantidad de elementos por página
        $perPage = 10; // Por ejemplo, 10 elementos por página
        
        // Obtener las comunidades paginadas
        $communitiesList = communities::paginate($perPage, ['*'], 'page', $page);
        $idUser = $user->id; 
        $isMember = $this->isMember($idUser);
        return response()->json([
            'communities' => $communitiesList,
            'user' => $user, 
            'isMember' => $isMember,
           
        ]);
    }

    public function communitiesUserId() 
    {
        $user = Auth::user();
        $communitiesUserIds = $user->communities->pluck('id')->toArray();
        return $communitiesUserIds;
    }

    public function userActual() 
    {
        $user = Auth::user();
        return $user;
    }

   

}
