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

    //store data in DB
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

    //retorne communitats a les que pertany el usuari
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

    
    /////////////////////////////////retorne llista de communitats obertes
    public function communitiesOpen() 
    {
        $communitiesOpen = communities::where('private', 0)->get();
        return $communitiesOpen;
    }

    ////////////////////////////////////////////////////////LLISTA PRINCIPAL DE COMUNITATS
 public function communitiesList(Request $request) 
{
    $user = Auth::user();
    $page = $request->input('page', 1);
    $perPage = 10;

    // Obtener los IDs de las comunidades del usuario
    $communitiesUserIds = $user->communities->pluck('id')->toArray();
    
    // Inicializar una consulta base para obtener todas las comunidades activas
    $query = communities::where('isActive', 1);

    // Si se proporciona un término de búsqueda, aplicar el filtro
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where('name', 'like', '%' . $searchTerm . '%');
    }

    // Si se proporciona un ID de región, aplicar el filtro
    if ($request->has('regionId')) {
        $regionId = $request->input('regionId');
        $query->where('id_region', $regionId);
    }

    // Si se proporciona un ID de comunidad autónoma, aplicar el filtro
    if ($request->has('communityAutId')) {
        $communityAutId = $request->input('communityAutId');
        $query->where('id_autonomousCommunity', $communityAutId);
    }

    // Ejecutar la consulta paginada
    $communitiesList = $query->paginate($perPage, ['*'], 'page', $page);

    // Agregar un campo adicional a cada comunidad para indicar si el usuario es miembro
    $communitiesList->getCollection()->transform(function ($community) use ($communitiesUserIds) {
        $community->isMember = in_array($community->id, $communitiesUserIds);
        return $community;
    });

    return response()->json([
        'communities' => $communitiesList,
        'user' => $user,
    ]);
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////7
    public function communitiesUserId() 
    {
        $user = Auth::user();
        $communitiesUserIds = $user->communities->pluck('id')->toArray();
        return $communitiesUserIds;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function userActual() 
    {
        $user = Auth::user();
        return $user;
    }

}
