<?php

namespace App\Http\Controllers;

use App\Models\Staff;

class AboutController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::with('user')
            ->where('is_active', true)
            ->take(3)
            ->get();

        return view('about', compact('staffMembers'));
    }
}