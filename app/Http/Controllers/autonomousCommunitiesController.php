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
                'autonomousCommunities.id as community_id',
                'autonomousCommunities.name as community_name'
            )
            ->get();
    
        return response()->json(['data' => $communitiesAut]);    
    }

    public function regionList($communityAut_id) {
        $regions = DB::table('regions')
                        ->select(
                            'id as region_id',
                            'name as region_name'
                        )
                        ->where('id_autonomousCommunity', $communityAut_id)
                        ->get();
    
        return response()->json(['data' => $regions]);
    }


    
}
