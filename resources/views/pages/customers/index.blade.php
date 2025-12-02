<x-layouts.app>
    <x-layouts.partials.breadcrumbs :links="[
        ['label' => 'Дашборд', 'url' => route('dashboard')],
        ['label' => 'Заказчики', 'url' => route('customers.index')],
    ]" />

    <x-layouts.content-fluid>

        <div class="flex justify-end p-3">
            <x-shared.button href="#">
                Добавить
            </x-shared.button>
        </div>

        <x-shared.table :headers="[
            'Название',
            'Ответственный менеджер'
        ]">

            @foreach ($customers as $customer)
                <tr class="bg-white hover:bg-slate-100 transition-colors duration-150 text-sm">
                
                    <td class="px-4 py-3 font-medium text-slate-700">
                        <div class="flex items-center gap-2">
                        <a href="{{ route('customers.overview', $customer) }}" class="text-sky-500 hover:underline">
                            {{ $customer->number . ' - '. $customer->name }}
                        </a>
                        @unless (!$customer->is_archived)
                            <span title="Архивировано" class="text-slate-400">
                            Архив
                            </span>
                        @endunless
                        </div>
                    </td>
                    <td class="px-4 py-3 text-slate-700">
                        {{ !empty($customer->user) ? $customer->user->first_name . " " . $customer->user->last_name : '—' }}
                    </td>
                </tr>
            @endforeach
            </x-shared.table>
    
    
    </x-layouts.content-fluid>
</x-layouts.app>