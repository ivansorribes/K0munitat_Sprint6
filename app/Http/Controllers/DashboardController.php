<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\communities;
use App\Models\posts;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $communityCount = Communities::count();
        $postCount = Posts::where('type', 'post')->count();
        $advertisementCount = Posts::where('type', 'advertisement')->count();

        return view('adminPanel.dashboard', compact('userCount', 'communityCount', 'postCount', 'advertisementCount'));
    }
}
