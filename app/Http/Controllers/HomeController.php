<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::with('user')
            ->where('is_active', true)
            ->take(3)
            ->get();

        $services = Service::where('is_active', true)
            ->take(3)
            ->get();

        return view('home', compact('staffMembers', 'services'));
    }
}
