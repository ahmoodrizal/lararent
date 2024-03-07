@props(['status'])

@php
    switch ($status) {
        case 'pending':
            $color = 'text-yellow-800 bg-yellow-100';
            break;
        case 'cancelled':
            $color = 'text-red-800 bg-red-100';
            break;
        case 'refund':
            $color = 'text-purple-800 bg-purple-100';
            break;
        default:
            $color = 'text-green-800 bg-green-100';
            break;
    }
@endphp

<div
    class="inline-block px-2 py-1 text-xs font-semibold leading-4 uppercase rounded-full whitespace-nowrap {{ $color }}">
    {{ $slot }}
</div>
