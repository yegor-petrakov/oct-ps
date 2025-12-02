<x-layouts.app>
    <x-layouts.partials.breadcrumbs :links="[
        ['label' => 'Дашборд', 'url' => route('dashboard')],
        ['label' => 'Пользователи', 'url' => route('users.index')],
        ['label' => '@'. $user->username],
    ]" />
    
    <x-layouts.partials.page-header
        :title="$user->first_name . ' ' . $user->last_name" 
        :editRoute="route('users.edit', $user)" 
    />

    <x-layouts.content>

        <x-shared.tabs :tabs="[
            ['label' => 'Общие сведения', 'route' => route('users.overview', $user)],
            ['label' => 'Заказчики', 'route' => route('users.index', $user)],
            ['label' => 'Выезды', 'route' => route('users.index', $user)],
            ['label' => 'Статистика', 'route' => route('users.index', $user)],
        ]" />

        <x-shared.overview-list>   

            <x-shared.overview-item 
                label="Имя пользователя" 
                :value="$user->username" 
            />

            <x-shared.overview-item 
                label="Полное имя" 
                :value="trim($user->last_name . ' ' . $user->first_name . ' ' . ($user->middle_name ?? ''))"  
            />

            <x-shared.overview-item 
                label="Электронная почта" 
                :value="$user->email" 
            />

            <x-shared.overview-item 
                label="Номер телефона" 
                :value="$user->phone" 
            />

            <x-shared.overview-item 
                label="Роли" 
                :value="$user->roles->pluck('name')->join(', ')" 
            />

            <div class="flex items-center gap-6 text-xs text-slate-500 mt-4 pt-4 border-t border-slate-200">
                <p>Создана: {{ $user->created_at->format('d.m.Y H:i') }}</p>
                <p>Обновлена: {{ $user->updated_at->format('d.m.Y H:i') }}</p>
            </div>

        </x-shared.overview-list>
        
    </x-layouts.content>
</x-layouts.app>