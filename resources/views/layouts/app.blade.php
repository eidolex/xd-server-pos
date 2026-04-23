<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="bg-bg text-text font-sans overflow-hidden selection:bg-text selection:text-bg">

    <div class="h-screen flex flex-col overflow-hidden">

        {{-- ═══ HEADER ═══ --}}
        <header class="h-14 shrink-0 bg-bg flex justify-between items-center px-6 border-b border-border z-50">
            <div class="text-xl font-bold tracking-widest uppercase text-text font-headline">Sovereign POS</div>

            <div class="flex items-center gap-8">
                <nav class="hidden md:flex items-center gap-6">
                    <a href="#"
                        class="text-text font-bold border-b-2 border-line text-2xs uppercase tracking-wider h-14 flex items-center">Terminal</a>
                    <a href="#"
                        class="text-subtext hover:text-text transition-colors text-2xs uppercase tracking-wider h-14 flex items-center">Analytics</a>
                    <a href="#"
                        class="text-subtext hover:text-text transition-colors text-2xs uppercase tracking-wider h-14 flex items-center">Ledger</a>
                </nav>

                <div class="flex items-center gap-4">
                    <button x-data="{ dark: document.documentElement.classList.contains('dark') }"
                        x-on:click="dark = !dark; document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', dark ? 'dark' : 'light')"
                        class="material-symbols-outlined text-text cursor-pointer hover:text-subtext transition-colors"
                        x-text="dark ? 'light_mode' : 'dark_mode'">
                    </button>
                    <span
                        class="material-symbols-outlined text-text cursor-pointer hover:text-subtext transition-colors">settings</span>
                    <span
                        class="material-symbols-outlined text-text cursor-pointer hover:text-subtext transition-colors">account_balance_wallet</span>
                    <div class="w-8 h-8 rounded-full bg-overlay overflow-hidden border border-border shrink-0">
                        <div class="w-full h-full bg-panel flex items-center justify-center">
                            <span class="material-symbols-outlined text-subtext text-base">person</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- ═══ BODY ═══ --}}
        <div class="flex flex-1 min-h-0">
            <x-app-navigation />

            <main class="flex flex-1 min-w-0 pb-16 md:pb-0 @container/main">
                {{ $slot }}
            </main>
        </div>

    </div>

    @livewireScripts
</body>

</html>
