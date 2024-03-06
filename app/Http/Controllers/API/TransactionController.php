<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $court = Court::find($request['court_id']);

        // Check if booked date at weekday or weekend to calculate total_price


        $data =  $request->validate([
            'court_id' => ['required', 'exists:courts,id'],
            'booked_at' => ['required', 'integer'],
            'payment_method' => ['required', 'in:bank_transfer,qris,cstore'],
            'payment_service' => ['required', 'in:bca,bni,bri,mandiri,gopay,qris,shopeepay,indomaret,alfamart'],
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['court_id'] = $court->id;
        $data['total_price'] = 0;
    }
}
