<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use App\Models\communities;

use Illuminate\Http\Request;

class CommunitiesController extends Controller
{
    public function create()
    {
        return view('communities.communitiesFormCreate');
    }

    public function index()
    {
        $po = communities::All();
        return $po;
        //return view('communities.CommunitiesList');
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
            $community = Communities::create($validatedData);
    
            // Redirigir de vuelta al formulario después de la presentación
            return response()->json(['message' => 'Community created successfully']);
        } catch (ValidationException $e) {
            // Captura de errores de validación
            return redirect()->route('communities.create')->withErrors($e->errors());
        }
    }
    
    public function show($id)
    {
        return view('XXXXXXX');
    }

    public function edit(communities $modelo)
    {
        return view('nombre_del_modelo.edit', compact('modelo'));
    }

    public function update(Request $request, $id)
    {
        $communities=communities::findOrFail($request->$id);
        $communities->name = $request->name();
        $communities->id_autonomousCommunity = $request->id_autonomousCommunity();
        $communities->id_region = $request->id_region();
        $communities->isActive = $request->isActive();
        $communities->save();
    }

    public function destroy($id)
    {
        $communities = communities::destroy($id);
        return $communities;
    }
}
