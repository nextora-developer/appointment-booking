<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\BusinessHour;
use Carbon\Carbon;

class TimeSlotService
{
    public function getAvailableSlots(string $date, ?int $staffId = null, int $intervalMinutes = 30): array
    {
        $carbonDate = Carbon::parse($date);
        $dayName = strtolower($carbonDate->format('l')); // monday, tuesday...

        $businessHour = BusinessHour::where('day', $dayName)->first();

        if (! $businessHour || $businessHour->is_closed || ! $businessHour->open_time || ! $businessHour->close_time) {
            return [];
        }

        $open = Carbon::parse($date . ' ' . $businessHour->open_time);
        $close = Carbon::parse($date . ' ' . $businessHour->close_time);

        $slots = [];

        while ($open < $close) {
            $slots[] = $open->format('H:i');
            $open->addMinutes($intervalMinutes);
        }

        $bookedQuery = Appointment::query()
            ->where('appointment_date', $date)
            ->whereIn('status', ['pending', 'confirmed']);

        if ($staffId) {
            $bookedQuery->where('staff_id', $staffId);
        }

        $bookedTimes = $bookedQuery
            ->pluck('appointment_time')
            ->map(fn($time) => Carbon::parse($time)->format('H:i'))
            ->toArray();

        return array_values(array_filter($slots, function ($slot) use ($bookedTimes) {
            return ! in_array($slot, $bookedTimes);
        }));
    }

    public function isSlotAvailable(string $date, string $time, ?int $staffId = null): bool
    {
        $availableSlots = $this->getAvailableSlots($date, $staffId);

        return in_array(Carbon::parse($time)->format('H:i'), $availableSlots);
    }
}
