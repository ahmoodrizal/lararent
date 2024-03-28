<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Court;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CreateQrCodeService;
use App\Services\Midtrans\CreateRetailService;
use App\Services\Midtrans\CreateVirtualAccountService;

class HomeController extends Controller
{
    public function index()
    {
        $courts = Court::whereIsActive(true)->orderBy('type')->get();

        return view('user.welcome', compact('courts'));
    }

    public function schedule(Court $court, Request $request)
    {
        if (!$request->query('filter')) {
            $currentTime = Carbon::now()->startOfDay()->addHours(9);
        } else {
            $currentTime = Carbon::parse($request['filter'])->startOfDay()->addHours(9);
        }

        $schedules = [];
        while ($currentTime->hour <= 21) {       // close at 9 pm
            $time = $currentTime->timestamp;
            // Check if schedule is exists at that time
            $isBooked = Schedule::where([
                ['court_id', '=', $court->id],
                ['booking_start', '=', $currentTime],
            ])->exists();

            $status = $isBooked ? 'booked' : 'available';

            $schedules[] = [
                'booking_time' => Carbon::createFromTimestamp($time)->format('H:i'),
                'status' => $status,
            ];

            $currentTime->addHour();
        }

        return view('user.schedule', compact('court', 'schedules'));
    }

    public function order(Court $court, Request $request)
    {
        $payment_service = $request['payment_service'];
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
            'booking_time' => ['required'],
            'hours' => ['required', 'integer'],
            'payment_service' => ['required', 'in:bca,bni,bri,qris,indomaret,alfamart']
        ]);

        $data['court_id'] = $court->id;
        // Convert epoch to timestamp for booked_time
        $data['booking_start'] = $booking_start;
        $data['booking_end'] = $booking_end;

        // Check if booked date at weekday or weekend to calculate total_price
        $data['total_price'] = $booking_start->isWeekday() ? $court->weekday_price * $request['hours'] : $court->weekend_price * $request['hours'];

        $data['user_id'] = Auth::user()->id;
        $data['unique_code'] = 'TRX-' . rand(000000, 999999);
        $data['expired_at'] = now()->addHour();
        $data['payment_service'] = $payment_service;

        // Define payment method depend on payment service
        if ($payment_service == 'bca' || $payment_service == 'bri' || $payment_service == 'bni') {
            $data['payment_method'] = 'bank_transfer';
        } elseif ($payment_service == 'qris') {
            $data['payment_method'] = 'qris';
        } else {
            $data['payment_method'] = 'cstore';
        }

        $transaction = Transaction::create($data);

        if ($data['payment_method'] == 'bank_transfer') {
            // Midtrans Virtual Account Integration with Core API
            $midtrans = new CreateVirtualAccountService($transaction->load('user', 'court'));
            $apiResponse = $midtrans->getVirtualAccount();

            $transaction->payment_code = $apiResponse->va_numbers[0]->va_number;
            $transaction->save();
        } elseif ($data['payment_method'] == 'cstore') {
            // Midtrans Store or Retail Integration with Core API
            $midtrans = new CreateRetailService($transaction->load('user', 'court'));
            $apiResponse = $midtrans->getPaymentCode();

            $transaction->payment_code = $apiResponse->payment_code;
            $transaction->save();
        } else {
            // Midtrans QRIS Integration with Core API
            $midtrans = new CreateQrCodeService($transaction->load('user', 'court'));
            $apiResponse = $midtrans->getSnapToken();

            $transaction->payment_link = $apiResponse->actions[0]->url;
            $transaction->save();
        }

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

        return redirect(route('payment', $transaction));
    }

    public function payment(Transaction $transaction)
    {
        return view('user.payment', compact('transaction'));
    }
}
