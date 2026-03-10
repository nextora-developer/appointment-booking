<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalServices = Service::count();
        $totalStaff = Staff::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalAppointments = Appointment::count();

        $recentAppointments = Appointment::with(['customer', 'service', 'staff.user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalServices',
            'totalStaff',
            'totalCustomers',
            'totalAppointments',
            'recentAppointments'
        ));
    }
}