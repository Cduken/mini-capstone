@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'relative px-4 py-2.5 text-sm font-medium text-white transition-all duration-300'
            : 'relative px-4 py-2.5 text-sm font-medium text-gray-300 hover:text-white transition-all duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    <span
        class="absolute left-4 right-4 bottom-0 h-px bg-gradient-to-r from-transparent via-white to-transparent transition-all duration-500 {{ $active ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></span>
</a>
