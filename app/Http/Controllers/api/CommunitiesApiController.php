<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\communities;
use Illuminate\Support\Facades\Auth;
use App\Models\User;




class CommunitiesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communities = communities::All();
        return $communities;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$community = communities::find($id);
        //return $community;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function communitiesUser() 
    {
        $user = auth()->user();
        $communities = $user->communities;
        return response()->json(['communities' => $communities], 200);
                //return view('communities.CommunitiesList')->with(['communities'=>$commun]);
    }
}
