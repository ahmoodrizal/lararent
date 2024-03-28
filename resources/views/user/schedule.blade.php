@extends('user.main-layout')

@section('content')
    <div class="w-full p-2 mx-auto my-10 rounded-md max-w-7xl">
        @if (session('success'))
            <x-alert :type="__('success')">{{ session('success') }}</x-alert>
        @endif
        @if (session('warning'))
            <x-alert :type="__('warning')">{{ session('warning') }}</x-alert>
        @endif
        <form action="{{ route('order', $court) }}" method="post">
            @csrf
            <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-4">
                <div
                    class="flex flex-col col-span-1 p-4 border-b md:border-r md:border-b-0 md:col-span-3 border-slate-400 gap-y-2">
                    <div class="flex items-center justify-center">
                        <p class="capitalize text-slate-700 font-header text-[16px]">{{ $court->name }}</p>
                        <p class="mx-4">|</p>
                        <p class="uppercase text-slate-700 font-header text-[16px]">{{ $court->type }}</p>
                    </div>
                    <div class="grid justify-between w-full gap-4 mt-4 md:grid-cols-5">
                        <img src="{{ Storage::url('banners/' . $court->banner) }}" alt="banner"
                            class="object-cover w-full col-span-1 rounded-md md:col-span-3 max-h-60">
                        <div class="flex flex-col col-span-1 md:col-span-2 gap-y-2">
                            <div class="flex items-start justify-between">
                                <p class="text-sm font-medium capitalize text-slate-700">Weekday Price</p>
                                <p class="text-sm capitalize text-slate-700">
                                    {{ Number::currency($court->weekday_price, 'IDR', 'id_ID') }}</p>
                            </div>
                            <div class="flex items-start justify-between col-span-2">
                                <p class="text-sm font-medium capitalize text-slate-700">Weekend Price</p>
                                <p class="text-sm capitalize text-slate-700">
                                    {{ Number::currency($court->weekend_price, 'IDR', 'id_ID') }}</p>
                            </div>
                            <div class="flex flex-col items-start justify-center col-span-2">
                                <p class="text-sm font-medium capitalize text-slate-700">Description</p>
                                <p class="text-xs leading-relaxed text-justify capitalize text-slate-700">
                                    {{ $court->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full h-full mt-8 gap-y-2">
                        <p class="capitalize text-slate-700 text-[16px] mb-4">Schedule</p>
                        <x-input-error :messages="$errors->get('booking_time')" class="mt-2" />
                        <div class="grid items-center grid-cols-4 gap-3 md:grid-cols-6">
                            @foreach ($schedules as $schedule)
                                <div class="flex items-center border border-gray-200 rounded ps-4">
                                    <input id="bordered-radio-{{ $schedule['booking_time'] }}" type="radio"
                                        value="{{ $schedule['booking_time'] }}" name="booking_time"
                                        {{ $schedule['status'] == 'booked' ? 'disabled' : '' }}
                                        class="w-4 h-4 text-orange-400 {{ $schedule['status'] == 'booked' ? 'bg-red-400 border-red-400' : 'bg-gray-100 border-gray-300' }} focus:ring-orange-300 dark:focus:ring-orange-400 focus:ring-2">
                                    <label for="bordered-radio-{{ $schedule['booking_time'] }}"
                                        class="w-full py-4 text-xs font-medium {{ $schedule['status'] == 'booked' ? 'text-red-400' : 'text-slate-700' }} capitalize ms-2">{{ $schedule['booking_time'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex flex-col col-span-1 p-4 gap-y-2">
                    <p class="capitalize text-slate-700 font-header text-[16px]">Checkout</p>
                    <div class="p-4 mb-2 bg-yellow-200 border border-yellow-400 rounded-md">
                        <p class="text-xs font-light tracking-wider text-justify text-yellow-600">
                            Please make sure the schedule is empty when booking for more than 1 hour
                        </p>
                    </div>
                    <div class="">
                        <p class="text-sm capitalize text-slate-700">Jumlah Jam</p>
                        <select id="hours" name="hours"
                            class="w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option class="text-sm capitalize" value="1">1</option>
                            <option class="text-sm capitalize" value="2">2</option>
                            <option class="text-sm capitalize" value="3">3</option>
                            <option class="text-sm capitalize" value="4">4</option>
                            <option class="text-sm capitalize" value="5">5</option>
                        </select>
                        <x-input-error :messages="$errors->get('hours')" class="mt-2" />
                    </div>
                    <div class="mt-2">
                        <p class="text-sm capitalize text-slate-700">Metode Pembayaran</p>
                        <select id="payment_service" name="payment_service"
                            class="w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option class="text-sm capitalize" value="qris">QRIS</option>
                            <option class="text-sm capitalize" value="bca">Bank Central Asia</option>
                            <option class="text-sm capitalize" value="bri">Bank Rakyat Indonesia</option>
                            <option class="text-sm capitalize" value="bni">Bank Negara Indonesia</option>
                            <option class="text-sm capitalize" value="indomaret">Indomaret</option>
                            <option class="text-sm capitalize" value="alfamart">Alfamart</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment_service')" class="mt-2" />
                    </div>
                    <button type="submit"
                        class="px-4 py-3 mt-4 text-xs font-medium text-white capitalize bg-orange-400 rounded-md hover:bg-orange-500">Pay
                        Now</button>
                </div>
            </div>
        </form>
    </div>
@endsection
