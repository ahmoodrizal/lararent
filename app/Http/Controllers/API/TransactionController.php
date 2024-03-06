<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $court = Court::find($request['court_id']);
        $booked_time = Carbon::createFromTimestamp($request['booked_at']);

        // Check if schedule is exist
        $exists = Transaction::where([
            ['court_id', '=', $court->id],
            ['booked_at', '=', $booked_time]
        ])->first();

        if ($exists) {
            return response()->json([
                'message' => 'Sorry, this schedule already booked'
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
            'booked_at' => ['required', 'integer'],
            'payment_method' => ['required', 'in:bank_transfer,qris,cstore'],
            'payment_service' => ['required', 'in:bca,bni,bri,mandiri,gopay,qris,shopeepay,indomaret,alfamart'],
        ]);

        // Check if booked date at weekday or weekend to calculate total_price
        $data['total_price'] = $booked_time->isWeekday() ? $court->weekday_price : $court->weekend_price;

        // Convert epoch to timestamp for booked_time
        $data['booked_at'] = $booked_time;

        $data['user_id'] = Auth::user()->id;
        $data['court_id'] = $court->id;
        $data['unique_code'] = 'TRX-' . rand(000000, 999999);
        $data['expired_at'] = now()->addHour();

        $transaction = Transaction::create($data);

        return response()->json([
            'message' => 'Success',
            'schedule' => $transaction
        ], 201);
    }
}
