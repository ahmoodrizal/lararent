@extends('user.main-layout')

@section('content')
    {{-- Jumbotron Start --}}
    @include('components.jumbotron')
    {{-- Jumbotron End --}}

    {{-- Booking Area Start --}}
    <div id="booking_area" class="w-full h-full p-10 mx-auto rounded-md max-w-7xl bg-slate-100 my-14">
        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
            @foreach ($courts as $court)
                <div class="flex flex-col items-center p-4 gap-y-3">
                    <div class="relative w-full overflow-hidden cursor-pointer group">
                        <div
                            class="absolute items-center justify-center hidden w-full h-full rounded-md bg-black/60 group-hover:flex">
                            <a href="{{ route('schedule', $court->slug) }}"
                                class="px-4 py-2 text-sm font-semibold text-center text-white border border-white rounded-md">Check
                                Schedule</a>
                        </div>
                        <img src="{{ Storage::url('banners/' . $court->banner) }}" alt="banner"
                            class="object-cover w-full rounded-md max-h-72">
                    </div>
                    <div class="flex items-center justify-between w-full">
                        <p class="text-sm tracking-wider capitalize font-header">{{ $court->name }}</p>
                        <div class="flex items-center gap-x-2">
                            <div
                                class="py-1 px-3 rounded-md border {{ $court->type == 'futsal' ? 'border-indigo-400' : 'border-green-400' }}">
                                <span class="text-xs tracking-widest uppercase">{{ $court->type }}</span>
                            </div>
                            @php
                                $today = \Carbon\Carbon::now();
                                $isWeekend = $today->isWeekend();
                            @endphp
                            <div class="px-3 py-1 border border-orange-400 rounded-md">
                                <span
                                    class="text-xs tracking-widest uppercase">{{ $isWeekend ? Number::currency($court->weekday_price, 'IDR', 'id_ID') : Number::currency($court->weekday_price, 'IDR', 'id_ID') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Booking Area End --}}
@endsection
