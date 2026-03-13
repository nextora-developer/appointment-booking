<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessHour;
use Illuminate\Http\Request;

class BusinessHourController extends Controller
{
    public function index()
    {
        $hours = BusinessHour::orderByRaw("
            FIELD(day,'monday','tuesday','wednesday','thursday','friday','saturday','sunday')
        ")->get();

        return view('admin.business-hours.index', compact('hours'));
    }

    public function update(Request $request)
    {
        foreach ($request->hours as $id => $data) {

            $hour = BusinessHour::find($id);

            $hour->update([
                'open_time' => $data['open_time'] ?: null,
                'close_time' => $data['close_time'] ?: null,
                'is_closed' => isset($data['is_closed']),
            ]);
        }

        return back()->with('success', 'Business hours updated.');
    }
}
