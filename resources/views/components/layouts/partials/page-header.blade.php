<div class="border-b border-slate-200 shadow-xs relative">
    <div class="mx-auto max-w-4xl h-full">
        <div class="flex justify-between items-center p-3">
            <h1 class="text-xl font-semibold text-slate-600 flex items-center gap-2 h-10">
                {{ $title }}
            </h1>

            <x-shared.button 
                :href="$editRoute" 
                variant="default" 
                size="default"
            >
                Редактировать
            </x-shared.button>
        </div>
    </div>
</div>