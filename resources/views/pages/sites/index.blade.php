<x-layouts.app>
    <x-layouts.partials.breadcrumbs :links="[
        ['label' => 'Дашборд', 'url' => route('dashboard')],
        ['label' => 'Объекты', 'url' => route('sites.index')],
    ]" />

    <x-layouts.content-fluid>

        <div class="flex justify-end p-3">
            <x-shared.button href="#">
                Добавить
            </x-shared.button>
        </div>

        <x-shared.table :headers="[
            'Название',
            'Адрес'
        ]">
        @foreach ($sites as $site)
            <tr class="bg-white hover:bg-slate-100 transition-colors duration-150 text-sm">
                <td class="px-4 py-3 font-medium text-slate-700">
                    <div class="flex items-center gap-2">
                        <a href="#" class="text-sky-500 hover:underline">
                            {{ $site->name }}
                        </a>
                        @unless (!$site->is_archived)
                            <span title="Архивировано" class="text-slate-400">
                            Архив
                            </span>
                        @endunless
                    </div>
                </td>
                <td class="px-4 py-3 text-slate-700">
                    {{ !empty($site->address) ? $site->address : '—' }}
                </td>
            </tr>
        @endforeach
        </x-shared.table>

    </x-layouts.content-fluid>
</x-layouts.app>