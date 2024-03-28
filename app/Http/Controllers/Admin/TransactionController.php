<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Court;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function dashboard()
    {
        $transactions = Transaction::with('user', 'court')->latest()->take(10)->get();
        $courts = Court::whereIsActive(true)->get();

        // Statistic
        $revenueData = Transaction::selectRaw('COUNT(*) as count, SUM(total_price) as sum')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->whereStatus('success')
            ->first();

        $today = Transaction::selectRaw('COUNT(*) as count')->whereDate('booking_start', now())->first();

        return view('dashboard', compact('transactions', 'courts', 'revenueData', 'today'));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $court = Court::find($request['court_id']);
        $booking_start = Carbon::parse($request['booking_time'])->startOfHour();
        $booking_end = $booking_start->copy()->addHours($request['hours']);

        // Validate booked date only maximum 1 week ahead
        $future = Carbon::parse($booking_start)->startOfDay()->diffInDays(now()->startOfDay());

        if ($future >= 7) {
            return redirect()->back()->with('warning', 'can only book a week ahead');
        }

        // Validate if booked_time over than 10PM (Closed)
        if ($booking_end->hour >= 23 || $booking_end->hour < 10) {
            return redirect()->back()->with('warning', 'Bookings cannot be made later than 9 pm');
        }

        $exists_schedule = [];
        // Check Schedule
        for ($i = 0; $i < $request['hours']; $i++) {
            $schedule = Schedule::where([
                ['court_id', '=', $court->id],
                ['booking_start', '=', $booking_start->copy()->addHours($i)]
            ])->first();

            if ($schedule) {
                $exists_schedule[] = $schedule;
            }
        }

        if ($exists_schedule) {
            return redirect()->back()->with('warning', 'This schedule already booked');
        }

        $data = $request->validate([
            'court_id' => ['required', 'exists:courts,id'],
            'booking_time' => ['required', 'date'],
            'hours' => ['required', 'integer']
        ]);


        // Convert epoch to timestamp for booked_time
        $data['booking_start'] = $booking_start;
        $data['booking_end'] = $booking_end;

        // Check if booked date at weekday or weekend to calculate total_price
        $data['total_price'] = $booking_start->isWeekday() ? $court->weekday_price * $request['hours'] : $court->weekend_price * $request['hours'];

        $data['user_id'] = Auth::user()->id;
        $data['unique_code'] = 'TRX-' . rand(000000, 999999);
        $data['status'] = 'success';
        $data['payment_method'] = 'cash';
        $data['payment_service'] = 'cash';
        $data['expired_at'] = now()->addHour();

        $transaction = Transaction::create($data);

        // Create Schedule
        for ($i = 0; $i < $request['hours']; $i++) {
            $time_start = $booking_start->copy()->addHours($i);
            $time_end = $time_start->copy()->addHour();
            Schedule::create([
                'transaction_id' => $transaction->id,
                'court_id' => $court->id,
                'booking_start' => $time_start,
                'booking_end' => $time_end,
            ]);
        }

        return redirect()->back()->with('success', 'Transaction Success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('admin.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
