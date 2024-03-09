<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Schedule;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $court = Court::find($request['court_id']);
        $booked_time = Carbon::createFromTimestamp($request['booking_start']);
        $booked_end = $booked_time->copy()->addHours($request['hours']);

        $exists_schedule = [];
        // Check Schedule
        for ($i = 0; $i < $request['hours']; $i++) {
            $schedule = Schedule::where([
                ['court_id', '=', $court->id],
                ['booking_start', '=', $booked_time->copy()->addHours($i)]
            ])->first();

            if ($schedule) {
                $exists_schedule[] = $schedule;
            }
        }

        if ($exists_schedule) {
            return response()->json([
                'message' => 'Sorry, this schedule is already booked'
            ]);
        }

        // Validate booked date only maximum 1 week ahead
        $future = Carbon::parse($booked_time)->startOfDay()->diffInDays(now()->startOfDay());

        if ($future >= 7) {
            return response()->json([
                'message' => 'Sorry, Booking time is only maximum one week ahead'
            ]);
        }

        $data =  $request->validate([
            'court_id' => ['required', 'exists:courts,id'],
            'booking_start' => ['required', 'integer'],
            'hours' => ['required', 'integer'],
            'payment_method' => ['required', 'in:bank_transfer,qris,cstore'],
            'payment_service' => ['required', 'in:bca,bni,bri,mandiri,gopay,qris,shopeepay,indomaret,alfamart'],
        ]);

        // Check if booked date at weekday or weekend to calculate total_price
        $data['total_price'] = $booked_time->isWeekday() ? $court->weekday_price * $request['hours'] : $court->weekend_price * $request['hours'];

        // Convert epoch to timestamp for booked_time
        $data['booking_start'] = $booked_time;
        $data['booking_end'] = $booked_end;

        $data['user_id'] = Auth::user()->id;
        $data['court_id'] = $court->id;
        $data['unique_code'] = 'TRX-' . rand(000000, 999999);
        $data['expired_at'] = now()->addHour();

        $transaction = Transaction::create($data);

        // Create Schedule
        for ($i = 0; $i < $request['hours']; $i++) {
            $time_start = $booked_time->copy()->addHours($i);
            $time_end = $time_start->copy()->addHour();
            Schedule::create([
                'transaction_id' => $transaction->id,
                'court_id' => $court->id,
                'booking_start' => $time_start,
                'booking_end' => $time_end,
            ]);
        }

        return response()->json([
            'message' => 'Success',
            'transaction' => $transaction
        ], 201);
    }

    public function schedule(Request $request)
    {
        $request->validate([
            'court_id' => ['required', 'exists:courts,id'],
            'booking_date' => ['required', 'date'],
        ]);

        $booking_date = Carbon::parse($request['booking_date'])->startOfDay();

        if ($booking_date->isToday()) {
            $now = Carbon::now()->hour;
            $currentTime = $now < 9 ? $booking_date->copy()->addHours(9) : $booking_date->copy()->addHours($now  + 1);
        } else {
            $currentTime = $booking_date->copy()->addHours(9);      // open at 9 am
        }

        $schedules = [];

        while ($currentTime->hour <= 21) {       // close at 9 pm
            $time = $currentTime->timestamp;
            // Check if schedule is exists at that time
            $isBooked = Schedule::where([
                ['court_id', '=', $request['court_id']],
                ['booking_start', '=', $currentTime],
            ])->exists();

            $status = $isBooked ? 'booked' : 'available';

            $schedules[] = [
                'booking_time' => $time,
                'status' => $status,
            ];

            $currentTime->addHour();
        }

        return response()->json([
            'message' => 'success',
            'schedules' => $schedules
        ], 200);
    }
}
