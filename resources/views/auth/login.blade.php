<x-guest-layout>
    <!-- Status de session -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Bienvenue, merci de vous authentifier</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Adresse e-mail -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Se souvenir de moi -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

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

</x-guest-layout>

<script>
    // Appliquer le thème sauvegardé au chargement de la page
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
