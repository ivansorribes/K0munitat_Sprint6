<?php

namespace App\Http\Controllers;

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
        return view('communities.CommunitiesList');
    }

    public function store(Request $request)
    {
        $communities = new communities();
        $communities->name = $request->name();
        $communities->id_autonomousCommunity = $request->id_autonomousCommunity();
        $communities->id_region = $request->id_region();
        $communities->isActive = $request->isActive();
        $communities->save();
    }

    public function show($id)
    {
        return view('XXXXXXX');
    }

    public function edit(Communities $modelo)
    {
        return view('nombre_del_modelo.edit', compact('modelo'));
    }

    public function update(Request $request, $id)
    {
        $communities=Communities::findOrFail($request->$id);
        $communities->name = $request->name();
        $communities->id_autonomousCommunity = $request->id_autonomousCommunity();
        $communities->id_region = $request->id_region();
        $communities->isActive = $request->isActive();
        $communities->save();
    }

    public function destroy($id)
    {
        $communities=Communities::destroy($id);
        return $communities;
    }
}
