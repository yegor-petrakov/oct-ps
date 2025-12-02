<x-layouts.auth :title="__('Login')">

    <div class="w-full max-w-xl">
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-forms.input 
                    label="Логин" 
                    name="email" 
                    type="email" 
                    placeholder="your@email.com" 
                    autofocus 
                />
            </div>

            <div>
                <x-forms.input 
                    label="Пароль" 
                    name="password" 
                    type="password" 
                    placeholder="••••••••" 
                />
            </div>

            <button 
                class="bg-sky-400 w-full px-4 py-1.5 rounded-xl text-sky-50 font-semibold" 
                type="submit"
            >
                Войти
            </button>
        </form>
    </div>
</x-layouts.auth>
