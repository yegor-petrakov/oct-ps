<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-slate-800 antialiased">

    <div class="min-h-screen flex flex-col">
        <main class="flex-1 flex items-start mt-18 justify-center">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
