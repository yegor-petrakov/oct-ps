@props(['tabs'])

<section class="pt-6 max-w-6xl overflow-x-auto" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
    <div class="flex flex-nowrap h-12 py-1 space-x-2 relative overflow-x-scroll">

        @foreach($tabs as $tab)
            @php
                // Compare full URL (path + query)
                $isActive = request()->fullUrl() === $tab['route'];
            @endphp

            <div class="relative flex-shrink-0">
                <a 
                    href="{{ $tab['route'] }}"
                    class="py-2 px-3 rounded-md relative 
                        {{ $isActive 
                            ? 'text-slate-900' 
                            : 'text-slate-500 hover:bg-slate-100' }}"
                >
                    {{ $tab['label'] }}

                    @if ($isActive)
                        <div class="absolute font-semibold left-1/2 -translate-x-1/2 w-3/4 bottom-0 h-[2px] bg-sky-500 rounded-full"></div>
                    @endif
                </a>
            </div>
        @endforeach

    </div>
</section>