<?php

namespace App\Http\Controllers;

use App\Models\communitiesUsers;
use Illuminate\Http\Request;

class CommunitiesUserControler extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos de entrada
        $request->validate([
            'id_community' => 'required|numeric',
            'id_user' => 'required|numeric'
        ]);

        // Crea un nuevo objeto communitiesUsers con los datos proporcionados
        $communityUser = communitiesUsers::create([
            'id_community' => $request->id_community,
            'id_user' => $request->id_user
        ]);

        // Verifica si la creación fue exitosa
        if ($communityUser) {
            return response()->json(['message' => 'Community user created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create community user'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(communitiesUsers $communitiesUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(communitiesUsers $communitiesUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, communitiesUsers $communitiesUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(communitiesUsers $communitiesUsers)
    {
        //
    }
}
