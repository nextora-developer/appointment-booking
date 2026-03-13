<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->index('staff_id', 'appointments_staff_id_index');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropUnique('appointments_staff_date_time_unique');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unique(
                ['staff_id', 'appointment_date', 'appointment_time'],
                'appointments_staff_date_time_unique'
            );
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex('appointments_staff_id_index');
        });
    }
};
