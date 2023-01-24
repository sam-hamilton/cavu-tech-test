<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'user_id' => 1,
                'vehicle_registration' => 'H1 CAV',
                'payment' => '9900',
                'payment_method' => 'PayPal',
                'created_at' => today()->subDay(),
            ], [
                'user_id' => 2,
                'vehicle_registration' => 'B16 CAV',
                'payment' => '8900',
                'payment_method' => 'Card',
                'created_at' => today(),
            ],
        ]);
    }
}
