@extends('user.main-layout')

@section('content')
    <div class="flex flex-col items-center w-full p-4 mx-auto mt-10 rounded-md max-w-7xlgap-y-2">
        <p class="font-medium text-orange-500 capitalize font-header text-center md:text-[36px] text-2xl">Waiting for payment
        </p>
        <p class="mt-6 text-2xl font-medium text-center -tracking-wider font-header text-slate-700">
            {{ Number::currency($transaction->total_price, 'IDR', 'id_ID') }}</p>
        @if ($transaction->payment_method != 'qris')
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/undraw_Loading_re_5axr.png') }}" alt="loading-png"
                    class="object-cover my-2 max-w-80">
                @if ($transaction->payment_code != null)
                    <p class="font-semibold tracking-widest mb-2 text-slate-700 font-header text-[16px]">
                        {{ $transaction->payment_method == 'cstore' ? 'Payment Code Number' : 'Virtual Account Number' }}
                    </p>

                    <div class="px-5 py-3 mt-2 text-center border border-orange-500 rounded-md">
                        <p class="text-orange-500 text-[16px] tracking-widest">{{ $transaction->payment_code }}</p>
                    </div>
                @endif
            </div>
        @else
            <img src="{{ $transaction->payment_link }}" alt="payment-link" class="object-cover max-w-96">
        @endif
    </div>
@endsection
