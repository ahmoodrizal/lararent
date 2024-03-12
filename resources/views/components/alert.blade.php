@props(['type'])

@php
    switch ($type) {
        case 'success':
            $bgColor = 'text-green-900 bg-green-200';
            $contentColor = 'bg-green-200 text-green-500 focus:ring-green-400 hover:bg-green-200';
            break;
        case 'warning':
            $bgColor = 'text-yellow-900 bg-yellow-200';
            $contentColor = 'bg-yellow-200 text-yellow-500 focus:ring-yellow-400 hover:bg-yellow-200';
            break;
        case 'danger':
            $bgColor = 'text-red-900 bg-red-200';
            $contentColor = 'bg-red-200 text-red-500 focus:ring-red-400 hover:bg-red-200';
            break;
        default:
            $bgColor = 'text-green-900 bg-green-200';
            $contentColor = 'bg-green-200 text-green-500 focus:ring-green-400 hover:bg-green-200';
            break;
    }
@endphp

<div id="alert-3" class="flex items-center p-4 mb-4 rounded-lg {{ $bgColor }}" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        viewBox="0 0 20 20">
        <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">Info</span>
    <div class="text-sm font-medium ms-3">
        {{ $slot }}
    </div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5  inline-flex items-center justify-center h-8 w-8 {{ $contentColor }}"
        data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>
