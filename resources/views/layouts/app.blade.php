<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Bouton fixe bascule mode clair/sombre -->
    <!-- Bouton fixe bascule mode clair/sombre -->
    <div class="fixed z-50" style="top:100px; right:200px;">
    <button 
    onclick="toggleTheme()" 
    class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-700"
    aria-label="Basculer mode clair/sombre">
    <!-- Icône soleil visible en mode clair -->
    <img src="/img/sun.svg" alt="Mode clair" class="w-6 h-6 block dark:hidden" style="width:40px; height:40px;"/>
    <!-- Icône lune visible en mode sombre -->
    <img src="/img/moon.svg" alt="Mode sombre" class="w-6 h-6 hidden dark:block" style="width:40px; height:40px;"/>
    </button>
    </div>

    <script>
        // Appliquer le thème sauvegardé au chargement
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Fonction pour basculer le thème et enregistrer la préférence
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        }
    </script>
</body>
</html>
