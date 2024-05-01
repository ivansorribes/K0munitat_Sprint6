<?php

namespace App\Http\Controllers;

use App\Models\AutonomousCommunities; // Updated model name
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutonomousCommunitiesController extends Controller
{
    public function list() {
        $communitiesAut = DB::table('autonomousCommunities')
            ->select(
                'autonomousCommunities.id as id_autonomousCommunity',
                'autonomousCommunities.name as community_name'
            )
            ->get();
    
        return response()->json(['data' => $communitiesAut]);
    }

    public function regionList($id_autonomousCommunity) {
        $regions = DB::table('regions')
                        ->select(
                            'id as id_region',
                            'name as region_name'
                        )
                        ->where('id_autonomousCommunity', $id_autonomousCommunity)
                        ->get();
    
        return response()->json(['data' => $regions]);
    }
}
