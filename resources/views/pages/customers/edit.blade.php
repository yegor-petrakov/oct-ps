<x-layouts.app>
    <x-layouts.partials.breadcrumbs :links="[
        ['label' => 'Дашборд', 'url' => route('dashboard')],
        ['label' => 'Заказчики', 'url' => route('customers.index')],
        ['label' => $customer->number, 'url' => route('customers.overview', $customer)],
        ['label' => 'Редактирование', 'url' => '#']
    ]" />

    <x-layouts.content>
        <form 
            autocomplete="off"
            action="#" 
            method="POST"
            class="w-full mx-auto mt-10 space-y-6"
        >
            @csrf
            @method('PUT')

            <div>
                <x-forms.label text="Название" for="name" />
                <x-forms.input 
                    name="name" 
                    type="text" 
                    value="{{ old('name', $customer->name) }}"
                    required    
                />
                <x-forms.error field="name" />
            </div>

            <div class="flex justify-end gap-3 border-t border-slate-200 pt-6">
                <x-shared.button variant="ghost" href="{{ route('customers.overview', parameters: $customer) }}">Отмена</x-shared.button>
                <x-shared.button variant="approve" type="submit">Создать</x-shared.button>
            </div>
        </form>
    </x-layouts.content>
</x-layouts.app>