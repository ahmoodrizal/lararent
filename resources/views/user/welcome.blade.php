@extends('user.main-layout')

@section('content')
    {{-- Jumbotron Start --}}
    @include('components.jumbotron')
    {{-- Jumbotron End --}}

    {{-- Booking Area Start --}}
    <div id="booking_area" class="max-w-7xl w-full h-full p-10 bg-slate-100 mx-auto my-14 rounded-md">
        <div class="grid md:grid-cols-2 grid-cols-1 gap-3">
            @foreach ($courts as $court)
                <div class="p-4 flex flex-col gap-y-3 items-center">
                    <div class="relative overflow-hidden w-full group cursor-pointer">
                        <div
                            class="absolute w-full h-full bg-black/60 rounded-md hidden group-hover:flex items-center justify-center">
                            <a href="#"
                                class="text-white py-2 px-4 rounded-md text-sm border border-white font-semibold text-center">Booking
                                Now</a>
                        </div>
                        <img src="{{ Storage::url('banners/' . $court->banner) }}" alt="banner"
                            class="rounded-md max-h-72 w-full object-cover">
                    </div>
                    <div class="flex items-center justify-between w-full">
                        <p class="capitalize font-header text-sm tracking-wider">{{ $court->name }}</p>
                        <div class="flex gap-x-2 items-center">
                            <div
                                class="py-1 px-3 rounded-md border {{ $court->type == 'futsal' ? 'border-indigo-400' : 'border-green-400' }}">
                                <span class="uppercase text-xs tracking-widest">{{ $court->type }}</span>
                            </div>
                            @php
                                $today = \Carbon\Carbon::now();
                                $isWeekend = $today->isWeekend();
                            @endphp
                            <div class="py-1 px-3 rounded-md border border-orange-400">
                                <span
                                    class="uppercase text-xs tracking-widest">{{ $isWeekend ? Number::currency($court->weekday_price, 'IDR', 'id_ID') : Number::currency($court->weekday_price, 'IDR', 'id_ID') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Booking Area End --}}
@endsection
