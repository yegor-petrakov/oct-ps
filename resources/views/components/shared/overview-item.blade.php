<div class="space-y-1">
    <h2 class="text-sm font-medium text-slate-400">{{ $label }}</h2>

    <p class="text-slate-600 font-semibold">
        {{ !blank($value) ? $value : '—' }}
    </p>

    @if(!blank($description ?? null))
        <small class="text-xs text-slate-400">{{ $description }}</small>
    @endif
</div>
