@props(['for', 'text'])

<label 
    for="{{ $for }}"
    class="ml-1 block text-sm text-slate-600 mb-1"
>
    {{ $text }}
</label>