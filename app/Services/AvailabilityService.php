<?php

namespace App\Services;

use App\Models\Reservation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class AvailabilityService
{
    protected Carbon $from;
    protected Carbon $to;
    public function __construct(Carbon $from, Carbon $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function forPeriod() :array
    {
        return array_merge($this->emptyPeriod(), $this->forPeriodWithoutEmpty());
    }

    public function forPeriodWithoutEmpty() :array
    {
         return Reservation::query()
            ->select(DB::raw('DATE(date) as day'), DB::raw('count(*) as filled'))
            ->Has('booking')
            ->whereDate('date', '<=', $this->to)
            ->whereDate('date', '>=', $this->from)
            ->groupBy('date')
            ->pluck('filled', 'day')
            ->map(function($value) {
                return $this->maxCapacity() - $value;
            })
            ->toArray();
    }

    public function bookable() :bool
    {
        return collect($this->forPeriodWithoutEmpty())->doesntContain(0);
    }

    public function notBookable() :bool
    {
        return !$this->bookable();
    }

    private function emptyPeriod() :array
    {
        $period = CarbonPeriod::create($this->from, $this->to);

        $days = [];
        foreach ($period as $date) {
            $days[$date->format('Y-m-d')] = $this->maxCapacity();
        }

        return $days;
    }

    private function maxCapacity() :int
    {
        return config('carpark.capacity');
    }

}
