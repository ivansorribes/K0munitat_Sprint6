<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\communities;
use Illuminate\Http\Request;

class CommunitiesController extends Controller
{

    public function retornarComunitats()
    {
        // Obtener todas las comunidades con los usuarios asociados
        $communities = communities::with('admin', 'categories')->get();
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
            // Validación de datos
            $validatedData = $request->validate([
                'name' => 'required|string|max:254',
                'description' => 'required|string|max:254',
                'id_autonomousCommunity' => 'required',
                'id_region' => 'required',
                'private' => 'required|boolean',
                'id_admin' => 'required'
            ]);

            // Crear la comunidad
            $community = communities::create($validatedData);

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
}
