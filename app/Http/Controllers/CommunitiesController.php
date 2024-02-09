<?php

namespace App\Http\Controllers;

use App\Models\communities;
use Illuminate\Support\Facades\DB;

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

    public function comuAutonomus() {
        $communitiesAut = DB::table('autonomousCommunities')
            ->leftJoin('regions', 'autonomousCommunities.id', '=', 'regions.id_autonomousCommunity')
            ->select(
                'autonomousCommunities.id as community_id',
                'autonomousCommunities.name as community_name',
                'regions.id as region_id',
                'regions.name as region_name'
            )
            ->get();
    
        // Agrupar las regiones por comunidad autónoma
        $groupedCommunities = [];
        foreach ($communitiesAut as $community) {
            $groupedCommunities[$community->community_id]['community_id'] = $community->community_id;
            $groupedCommunities[$community->community_id]['community_name'] = $community->community_name;
            $groupedCommunities[$community->community_id]['regions'][] = [
                'region_id' => $community->region_id,
                'region_name' => $community->region_name,
            ];
        }
    
        return response()->json(['data' => array_values($groupedCommunities)]);
    }
}
