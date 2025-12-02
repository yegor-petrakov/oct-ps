<x-layouts.app>
    <x-layouts.partials.breadcrumbs :links="[
        ['label' => 'Дашборд', 'url' => route('dashboard')],
        ['label' => 'Пользователи', 'url' => route('users.index')],
    ]" />

    <x-layouts.content-fluid>

        <div class="flex justify-end p-3">
            <x-shared.button href="{{ route('users.create') }}">
                Добавить
            </x-shared.button>
        </div>

        <x-shared.table :headers="[
            'Имя пользователя',
            'Полное имя',
            'Роли',
            'Электронная почта',
            'Телефон',
        ]">

            @foreach ($users as $user)
                <tr class="bg-white hover:bg-slate-100 transition-colors duration-150 text-sm">
                
                <!-- Username + archived -->
                <td class="px-4 py-3 font-medium text-slate-700">
                    <div class="flex items-center gap-2">
                    <a href="{{ route('users.overview', $user) }}" class="text-sky-500 hover:underline">
                        {{ '@' . $user->username }}
                    </a>
                    @unless (!$user->is_archived)
                        <span title="Архивировано" class="text-slate-400">
                        Архив
                        </span>
                    @endunless
                    </div>
                </td>

                <!-- Full name -->
                <td class="px-4 py-3 font-medium text-slate-700">
                    {{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }}
                </td>
                
                <!-- Roles -->
                <td class="px-4 py-3 font-medium text-slate-700">
                    @foreach ($user->roles as $role)
                    <span class="inline-block px-2 py-1 text-xs font-medium rounded bg-sky-100 text-sky-700 mr-1">
                        {{ $role->name }}
                    </span>
                    @endforeach
                </td>

                <!-- Email -->
                <td class="px-4 py-3 font-medium text-slate-700">{{ $user->email }}</td>

                <!-- Phone -->
                <td class="px-4 py-3 font-medium text-slate-700">{{ $user->phone }}</td>


                </tr>
            @endforeach
            </x-shared.table>
    
    
    </x-layouts.content-fluid>
</x-layouts.app>