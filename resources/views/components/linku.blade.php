@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'group flex items-center gap-2 rounded-lg bg-neutral-100 px-3 py-1.5 text-sm font-medium text-neutral-950'
            : 'group flex items-center gap-2 rounded-lg px-3 py-1.5 text-sm font-medium text-neutral-800 hover:bg-neutral-100 hover:text-neutral-950 active:bg-neutral-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
