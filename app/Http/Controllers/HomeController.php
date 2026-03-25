<?php

namespace App\Http\Controllers;

use App\Models\Staff;

class HomeController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::with('user')
            ->where('is_active', true)
            ->take(3)
            ->get();

        return view('home', compact('staffMembers'));
    }
}
