<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            [
                'booking_id' => 1,
                'date' => today(),
                'created_at' => today()->subDay(),
            ], [
                'booking_id' => 1,
                'date' => today()->addDays(1),
                'created_at' => today()->subDay(),
            ], [
                'booking_id' => 1,
                'date' => today()->addDays(2),
                'created_at' => today()->subDay(),
            ], [
                'booking_id' => 1,
                'date' => today()->addDays(3),
                'created_at' => today()->subDay(),
            ], [
                'booking_id' => 2,
                'date' => today()->addDays(2),
                'created_at' => today(),
            ], [
                'booking_id' => 2,
                'date' => today()->addDays(3),
                'created_at' => today(),
            ], [
                'booking_id' => 2,
                'date' => today()->addDays(4),
                'created_at' => today(),
            ], [
                'booking_id' => 2,
                'date' => today()->addDays(5),
                'created_at' => today(),
            ], [
                'booking_id' => 2,
                'date' => today()->addDays(6),
                'created_at' => today(),
            ],
        ]);
    }
}
