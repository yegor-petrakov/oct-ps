@props(['variant' => 'default', 'size' => 'default', 'href' => null, 'disabled' => false, 'type' => 'button'])

@php
    $baseClasses = 'rounded-xl inline-flex items-center justify-center cursor-pointer font-semibold transition-all duration-150 focus:outline-none disabled:opacity-60 disabled:cursor-not-allowed';

    $variants = [
        'default' => 'text-sm bg-sky-400 font-semibold text-sky-50',
        'approve'=> 'text-sm bg-green-500 font-semibold text-green-50',
        'ghost' => 'text-sm bg-slate-50 font-semibold text-slate-500 hover:bg-slate-100'
    ];

    $sizes = [
        'default' => 'px-6 py-1 h-9',
    ];

    $classes = "$baseClasses " . ($variants[$variant] ?? $variants['default']) . " " . ($sizes[$size] ?? $sizes['default']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif