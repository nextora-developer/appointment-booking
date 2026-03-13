<?php

namespace Database\Seeders;

use App\Models\BusinessHour;
use Illuminate\Database\Seeder;

class BusinessHourSeeder extends Seeder
{
    public function run(): void
    {
        $hours = [
            ['day' => 'sunday',    'open_time' => null,    'close_time' => null,    'is_closed' => true],
            ['day' => 'monday',    'open_time' => '09:00', 'close_time' => '18:00', 'is_closed' => false],
            ['day' => 'tuesday',   'open_time' => '09:00', 'close_time' => '18:00', 'is_closed' => false],
            ['day' => 'wednesday', 'open_time' => '09:00', 'close_time' => '18:00', 'is_closed' => false],
            ['day' => 'thursday',  'open_time' => '09:00', 'close_time' => '18:00', 'is_closed' => false],
            ['day' => 'friday',    'open_time' => '09:00', 'close_time' => '18:00', 'is_closed' => false],
            ['day' => 'saturday',  'open_time' => '09:00', 'close_time' => '13:00', 'is_closed' => false],
        ];

        foreach ($hours as $hour) {
            BusinessHour::updateOrCreate(
                ['day' => $hour['day']],
                $hour
            );
        }
    }
}