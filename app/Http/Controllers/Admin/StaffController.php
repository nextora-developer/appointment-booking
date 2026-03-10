<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::with('user')->latest()->paginate(10);

        return view('admin.staff.index', compact('staffMembers'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'staff',
            ]);

            Staff::create([
                'user_id' => $user->id,
                'phone' => $validated['phone'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'is_active' => $validated['is_active'],
            ]);
        });

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff created successfully.');
    }

    public function show(Staff $staff)
    {
        $staff->load('user');

        return view('admin.staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        $staff->load('user');

        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $staff->load('user');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($staff->user->id),
            ],
            'password' => ['nullable', 'string', 'min:8'],
            'phone' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        DB::transaction(function () use ($validated, $staff) {
            $staff->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            if (! empty($validated['password'])) {
                $staff->user->update([
                    'password' => Hash::make($validated['password']),
                ]);
            }

            $staff->update([
                'phone' => $validated['phone'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'is_active' => $validated['is_active'],
            ]);
        });

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        DB::transaction(function () use ($staff) {
            $user = $staff->user;
            $staff->delete();

            if ($user) {
                $user->delete();
            }
        });

        return redirect()
            ->route('admin.staff.index')
            ->with('success', 'Staff deleted successfully.');
    }
}
