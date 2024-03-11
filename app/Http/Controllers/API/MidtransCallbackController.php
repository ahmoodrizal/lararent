<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Midtrans\CallbackService;

class MidtransCallbackController extends Controller
{
    public function callback()
    {
        $callback = new CallbackService();
        $transaction = $callback->getTransaction();

        // if ($callback->isSignatureKeyVerified()) {
        if ($callback->isSuccess()) {
            $transaction->update([
                'status' => 'success',
            ]);
        } else if ($callback->isExpire()) {
            $transaction->update([
                'status' => 'cancelled',
            ]);
        } else if ($callback->isCancelled()) {
            $transaction->update([
                'status' => 'cancelled',
            ]);
        }
        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Callback success',
            ],
        ]);
        // }

        // return response()->json([
        //     'meta' => [
        //         'code' => 400,
        //         'message' => 'Callback failed',
        //     ],
        // ]);
    }
}
