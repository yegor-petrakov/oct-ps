@props([
    'name',
    'type' => 'text',
    'placeholder' => '',
    'error' => false,
    'class' => '',
])

<input type="{{ $type }}" id="{{ $name }}" placeholder="{{ $placeholder }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'w-full px-3 py-1.5 rounded-xl text-slate-800 bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent']) }}>
