<x-layouts.app>
    <x-layouts.partials.breadcrumbs :links="[
        ['label' => 'Главная', 'url' => route('dashboard')],
        ['label' => 'Заказчики', 'url' => route('customers.index')],
        ['label' => $customer->number]
    ]" />

    <x-layouts.partials.page-header
        :title="$customer->name" 
        :editRoute="route('customers.edit', $customer)" 
    />

    <x-layouts.content>

        <x-shared.tabs :tabs="[
            ['label' => 'Общие сведения', 'route' => route('customers.overview', $customer)]
        ]" />

        <x-shared.overview-list>   
            <x-shared.overview-item label="Название компании" :value="$customer->name" />
            <x-shared.overview-item label="Исходящий номер" :value="$customer->number" />
            <x-shared.overview-item 
                label="Ответственный менеджер" 
                :value="$customer->user?->first_name . ' ' . $customer->user?->last_name"
            />
            <x-shared.overview-item label="Примечание" :value="$customer->note" />

            <div class="flex items-center gap-6 text-xs text-slate-500 mt-4 pt-4 border-t border-slate-200">
                <p>Создана: {{ $customer->created_at->format('d.m.Y H:i') }}</p>
                <p>Обновлена: {{ $customer->updated_at->format('d.m.Y H:i') }}</p>
            </div>
        </x-shared.overview-list> 
    
    </x-layouts.content>
</x-layouts.app>