<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Reservation;
use App\Services\AvailabilityService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Booking::query()
            ->with('reservations')
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'from' => ['required', 'date', 'after_or_equal:today'],
            'to' => ['required', 'date', 'after_or_equal:from'],
            'vehicle_registration' => ['required', 'max:255'],
            'payment_method' => ['required', 'max:255'],
        ]);

        $from = Carbon::createFromFormat('Y-m-d', $request->input('from'));
        $to = Carbon::createFromFormat('Y-m-d', $request->input('to'));

        $price = \App\Models\Price::query()
            ->cheapestOnDates($from, $to)
            ->amount;

        if((new AvailabilityService($from, $to))->notBookable()) {
            return response()->json([
                'error' => true,
                'message' => 'there is no availability for the dates requested'
            ]);
        }

        $booking = new Booking;
        $booking->user_id = 1;
        $booking->vehicle_registration = $request->input('vehicle_registration');
        $booking->payment = $price;
        $booking->payment_method = $request->input('payment_method');
        $booking->save();

        $period = CarbonPeriod::create($from, $to);
        $reservations = [];
        foreach ($period as $day) {
            $reservations[] = [
                'booking_id' => $booking->id,
                'date' => $day->format('Y-m-d'),
            ];
        }
        
        $booking->reservations()->createMany($reservations);

        return $booking->load('reservations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return $booking->load('reservations');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $validatedData = $request->validate([
            'vehicle_registration' => ['required', 'max:255'],
        ]);

        $booking->vehicle_registration = $request->input('vehicle_registration');
        $booking->save();

        return $booking->load('reservations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        if($booking->delete()) {
            return response()->json([
                'message' => 'booking was deleted successfully!'
            ]);
        }
        return response()->json([
                'error' => true,
                'message' => 'failed to delete the booking!'
        ]);
    }
}
