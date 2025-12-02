@props(['links' => []])


<div class="w-full relative bg-slate-100 border-b border-slate-300 shadow-xs">
  <div class="max-w-fit px-4 pr-6 h-8 flex items-center gap-2 text-sm">
    @foreach ($links as $index => $link)
      @if (!$loop->last)
        <a 
          href="{{ $link['url'] ?? '#' }}" 
          class="text-sky-800 hover:underline cursor-pointer">
          {{ $link['label'] }}
        </a>
        <svg class="text-sky-800" xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
             stroke-linecap="round" stroke-linejoin="round">
          <path d="m9 18 6-6-6-6"/>
        </svg>
      @else
        <span class="text-sky-800 font-semibold">{{ $link['label'] }}</span>
      @endif
    @endforeach
  </div>
</div>