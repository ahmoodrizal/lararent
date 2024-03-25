<?php

namespace App\Services\Midtrans;

use Carbon\Carbon;
use Midtrans\CoreApi;

class CreateQrCodeService extends Midtrans
{
    protected $transaction;

    public function __construct($transaction)
    {
        parent::__construct();

        $this->transaction = $transaction;
    }

    public function getSnapToken()
    {

        $court_price = Carbon::parse($this->transaction->booking_start)->isWeekday() ? $this->transaction->court->weekday_price :  $this->transaction->court->weekend_price;

        $start = Carbon::parse($this->transaction->booking_start);
        $end = Carbon::parse($this->transaction->booking_end);
        $total_hours = $start->diffInHours($end);

        $item_details[] = [
            'id' => $this->transaction->court->id,
            'price' => $court_price,
            'quantity' => $total_hours,
            'name' => 'Booking ' . $this->transaction->court->name,
        ];

        $params = [
            'payment_type' => $this->transaction->payment_service,
            'transaction_details' => [
                'order_id' => $this->transaction->unique_code,
                'gross_amount' => $this->transaction->total_price,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $this->transaction->user->name,
                'email' => $this->transaction->user->email,
                'phone' => $this->transaction->user->phone_number ??  '087723015713',
            ],
            'custom_expiry' => [
                "expiry_duration" => 60,
                "unit" => "minute"
            ],
        ];

        $response = CoreApi::charge($params);

        return $response;
    }
}
