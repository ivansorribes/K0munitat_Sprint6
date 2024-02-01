<?php

namespace App\Http\Controllers;

use App\Models\communities;
use Illuminate\Http\Request;

class CommunitiesController extends Controller
{
    public function create()
    {
        return view('communities.create');
    }

    public function store(Request $request)
    {
        communities::create($request->all());
        return redirect()->route('nombre_del_modelo.index');
    }

    public function show(communities $modelo)
    {
        return view('nombre_del_modelo.show', compact('modelo'));
    }

    public function edit(communities $modelo)
    {
        return view('nombre_del_modelo.edit', compact('modelo'));
    }

    public function update(Request $request, NombreDelModelo $modelo)
    {
        $modelo->update($request->all());
        return redirect()->route('nombre_del_modelo.index');
    }

    public function destroy(NombreDelModelo $modelo)
    {
        $modelo->delete();
        return redirect()->route('nombre_del_modelo.index');
    }
}
