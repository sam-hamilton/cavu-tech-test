<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Lowest price on a given date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCheapestOnDates($query, $from, $to)
    {
        return $query
            ->whereDate('start_date', '<=', $to)
            ->whereDate('end_date', '>=', $from)
            ->orderBy('amount')
            ->firstOrFail();
    }
}
