<header class="bg-[#1d335d] h-14">
    <div class="w-full flex justify-between items-center h-full px-3">
        <div class="flex items-center gap-6">
            <button 
                id="sidebar-toggle-btn"
                class="flex items-center justify-center h-7 w-7 cursor-pointer"
            >
                <x-icons.menu />
            </button>
            <a href="#">
                <img src="/logo.svg" alt="logo" class="w-36">
            </a>
        </div>

        <div class="hidden lg:flex">
            <a 
                class="font-semibold text-slate-300 hover:text-slate-50 px-3 py-1 rounded-xl" 
                href="{{ route('dashboard') }}"
            >
                Дашборд
            </a>
            <a class="font-semibold text-slate-300 hover:text-slate-50 px-3 py-1 rounded-xl" href="#">
                График
            </a>
            <a class="font-semibold text-slate-300 hover:text-slate-50 px-3 py-1 rounded-xl" href="{{ route('customers.index') }}">
                Заказчки
            </a>
            <a 
                class="font-semibold text-slate-300 hover:text-slate-50 px-3 py-1 rounded-xl" 
                href="{{ route('sites.index') }}"
            >
                Объекты
            </a>
            <a class="font-semibold text-slate-300 hover:text-slate-50 px-3 py-1 rounded-xl" href="#">
                Заявки
            </a>
            <a 
                class="font-semibold text-slate-300 hover:text-slate-50 px-3 py-1 rounded-xl" 
                href="{{ route('users.index') }}"
            >
                Пользователи
            </a>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="sm:flex flex-col items-end hidden">
                <p class="text-sm text-slate-200 p-0 font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <p class="text-xs text-slate-200 p-0">{{ auth()->user()->email }}</p>
            </div>
            <button id="user-menu-btn" class="cursor-pointer w-9 h-9 bg-slate-200 flex items-center justify-center rounded-xl">
                <x-icons.circle-user-round />
            </button>
        </div>

    </div>
</header>

<div id="sidebar" class="fixed h-screen bg-[#1d335d] max-w-96 w-full rounded-r-xl z-50 shadow-xs hidden">
    <div class="flex items-center justify-between gap-6 h-14 px-3 border-b border-slate-600">
        <a href="#">
            <img src="/logo.svg" alt="logo" class="w-36">
        </a>

        <button 
            id="sidebar-close-btn"
            class="flex items-center justify-center h-7 w-7 cursor-pointer"
        >
            <x-icons.close />
        </button>
    </div>

    <div class="flex flex-col p-3 space-y-3 text-slate-100">
        <a 
            class="font-semibold hover:bg-slate-100/20 px-3 py-1 rounded-xl" 
            href="{{ route('dashboard') }}"
        >
            Дашборд
        </a>
        <a class="font-semibold hover:bg-slate-100/20 px-3 py-1 rounded-xl" href="#">
            График
        </a>
        <a class="font-semibold hover:bg-slate-100/20 px-3 py-1 rounded-xl" href="#">
            Заказчки
        </a>
        <a class="font-semibold hover:bg-slate-100/20 px-3 py-1 rounded-xl" href="#">
            Объекты
        </a>
        <a class="font-semibold hover:bg-slate-100/20 px-3 py-1 rounded-xl" href="#">
            Заявки
        </a>
        <a 
            class="font-semibold hover:bg-slate-100/20 px-3 py-1 rounded-xl" 
            href="{{ route('users.index') }}"
        >
            Пользователи
        </a>
    </div>
</div>

<div id="sidebar-overlay" class="cursor-pointer fixed h-screen w-screen bg-slate-400 opacity-60 hidden"></div>
<div id="user-menu-overlay" class="cursor-pointer fixed h-screen w-screen hidden"></div>


<div id="user-menu" class="divide-y divide-slate-200 w-64 bg-white border border-slate-200 shadow-xl fixed top-[56px] right-0 m-0.5 rounded-md hidden z-60">
    <div class="flex items-center py-3 px-6 gap-3">
        <div>
            <p class="text-md text-slate-800 p-0 font-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
            <p class="text-sm font-medium text-sky-600 p-0">{{ auth()->user()->email }}</p>
        </div>
    </div>
    <div class="flex flex-col">
        <a class="px-3 py-1.5 hover:bg-slate-100" href="#">
            Профиль
        </a>
        <a class="px-3 py-1.5 hover:bg-slate-100" href="#">
            Настройки
        </a>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="cursor-pointer px-3 py-1.5 font-semibold text-red-500 w-full text-start">
            Выйти
        </button>
    </form>
</div>



<script>
    const sidebarToggleBtn = document.getElementById('sidebar-toggle-btn');
    const sidebarCloseBtn = document.getElementById('sidebar-close-btn');

    const sidebarOverlay = document.getElementById('sidebar-overlay');

    sidebarOverlay.addEventListener('click', (e) => {
        sidebarOverlay.classList.toggle('hidden');
        document.getElementById('sidebar').classList.toggle('hidden');
    });

    sidebarToggleBtn.addEventListener('click', (e) => {
        sidebarOverlay.classList.toggle('hidden');
        document.getElementById('sidebar').classList.toggle('hidden');
    });

    sidebarCloseBtn.addEventListener('click', (e) => {
        sidebarOverlay.classList.toggle('hidden');
        document.getElementById('sidebar').classList.toggle('hidden');
    });




    const userMenuBtn = document.getElementById('user-menu-btn');
    const userMenu = document.getElementById('user-menu');
    const userMenuOverlay = document.getElementById('user-menu-overlay');

    userMenuOverlay.addEventListener('click', (e) => {
        userMenu.classList.toggle('hidden');
        userMenuOverlay.classList.toggle('hidden')
    });

    userMenuBtn.addEventListener('click', (e) => {
        userMenu.classList.toggle('hidden');
        userMenuOverlay.classList.toggle('hidden')
    });

</script>