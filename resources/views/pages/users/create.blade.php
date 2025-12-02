<x-layouts.app>
    <x-layouts.partials.breadcrumbs :links="[
        ['label' => 'Главная', 'url' => route('dashboard')],
        ['label' => 'Пользователи', 'url' => route('users.index')],
        ['label' => 'Создать пользователя']
    ]" />

    <x-layouts.content>
        <form 
            autocomplete="off"
            action="{{ route('users.store') }}" 
            method="POST"
            class="w-full mx-auto mt-10 space-y-6"
        >
            @csrf

            <div>
                <x-forms.label text="Имя пользователя" for="username" />
                <x-forms.input name="username" type="text" required />
                <x-forms.error field="username" />
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <x-forms.label text="Имя" for="first_name" />
                    <x-forms.input name="first_name" type="text" required />
                    <x-forms.error field="first_name" />
                </div>
    
                <div>
                    <x-forms.label text="Фамилия" for="last_name" />
                    <x-forms.input name="last_name" type="text" />
                    <x-forms.error field="last_name" />
                </div>
    
                <div>
                    <x-forms.label text="Отчество" for="middle_name" />
                    <x-forms.input name="middle_name" type="text" />
                    <x-forms.error field="middle_name" />
                </div>
            </div>

            <div>
                <x-forms.label text="Электронная почта" for="email" />
                <x-forms.input name="email" type="email" required />
                <x-forms.error field="email" />
            </div>

            <div>
                <x-forms.label text="Электронная почта" for="phone" />
                <x-forms.input name="phone" type="text" required />
                <x-forms.error field="phone" />
            </div>

            <div>
                <x-forms.label text="Пароль" for="password" />
                <x-forms.input name="password" type="password" required />
                <x-forms.error field="password" />
            </div>

            <div>
                <x-forms.label text="Роли" for="roles[]" />
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach($roles as $role)
                        <label class="inline-flex items-center gap-1 border border-slate-200 rounded px-2 py-1 cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="roles[]" 
                                value="{{ $role->id }}" 
                                {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
                                required 
                            />
                            <span>{{ ucfirst($role->name) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-3 border-t border-slate-200 pt-6">
                <x-shared.button variant="ghost">Отмена</x-shared.button>
                <x-shared.button variant="approve" type="submit">Создать</x-shared.button>
            </div>

        </form>
    </x-layouts.content>
</x-layouts.app>
