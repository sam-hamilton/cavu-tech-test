<?php

namespace App\Http\Controllers;

use App\Services\AvailabilityService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $from = Carbon::createFromFormat('Y-m-d', $request->input('from'));
        $to = Carbon::createFromFormat('Y-m-d', $request->input('to'));

        return (new AvailabilityService($from, $to))->forPeriod();
    }
}
