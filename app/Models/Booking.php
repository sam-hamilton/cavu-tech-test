<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'from' => 'date',
        'to' => 'date',
        'payment' => 'decimal:2',
    ];

    /**
     * Get payment for humans.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function payment(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 0 ? 0 : $value / 100,
        );
    }

    /**
     * Get the user associated with the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reservations associated with the booking.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
