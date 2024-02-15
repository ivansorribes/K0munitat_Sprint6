<?php

namespace App\Http\Controllers;

use App\Models\communities;

class CommunitiesController extends Controller
{
    public function index()
    {
        $communities = communities::all();
        return view('index', compact('communities'));
    }
    public function stateChange($id)
    {
        $community = communities::findOrFail($id);
        $community->isActive = !$community->isActive;
        $community->save();

        return redirect()->back()->with('success', 'Estado cambiado exitosamente');
    }
}
