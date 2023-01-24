<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([
            [
                'description' => 'Winter',
                'amount' => 11000,
                'start_date' => Carbon::createFromDate(now()->year, 1, 1)->startOfDay(),
                'end_date' => Carbon::createFromDate(now()->year, 3, 19)->startOfDay(),
                'created_at' => now(),
            ], [
                'description' => 'Spring',
                'amount' => 12000,
                'start_date' => Carbon::createFromDate(now()->year, 3, 20)->startOfDay(),
                'end_date' => Carbon::createFromDate(now()->year, 6, 20)->startOfDay(),
                'created_at' => now(),
            ], [
                'description' => 'Summer early off-peak',
                'amount' => 12500,
                'start_date' => Carbon::createFromDate(now()->year, 6, 21)->startOfDay(),
                'end_date' => Carbon::createFromDate(now()->year, 7, 20)->startOfDay(),
                'created_at' => now(),
            ], [
                'description' => 'Summer peak',
                'amount' => 16000,
                'start_date' => Carbon::createFromDate(now()->year, 7, 21)->startOfDay(),
                'end_date' => Carbon::createFromDate(now()->year, 9, 5)->startOfDay(),
                'created_at' => now(),
            ], [
                'description' => 'Summer late off-peak',
                'amount' => 12500,
                'start_date' => Carbon::createFromDate(now()->year, 9, 6)->startOfDay(),
                'end_date' => Carbon::createFromDate(now()->year, 9, 23)->startOfDay(),
                'created_at' => now(),
            ], [
                'description' => 'Autumn',
                'amount' => 9900,
                'start_date' => Carbon::createFromDate(now()->year, 9, 24)->startOfDay(),
                'end_date' => Carbon::createFromDate(now()->year, 10, 31)->startOfDay(),
                'created_at' => now(),
            ], [
                'description' => 'Winter',
                'amount' => 9900,
                'start_date' => Carbon::createFromDate(now()->year, 11, 01)->startOfDay(),
                'end_date' => Carbon::createFromDate(now()->year, 12, 31)->startOfDay(),
                'created_at' => now(),
            ],
        ]);
    }
}
