<x-guest-layout>
    @php
        $orange = '#e7522e';
        $purple = '#400eb3';
        $slate  = '#5f6b73';
        $grad   = "linear-gradient(135deg, {$purple}, {$orange})";
    @endphp

    <x-slot name="header">
        <h1 class="text-2xl font-bold" style="color: {{ $purple }};">Connexion</h1>
        <p class="mt-2 text-sm" style="color: {{ $slate }};">
            Connectez-vous pour gérer vos dépenses de colocation.
        </p>
    </x-slot>

    @if (session('status'))
        <div class="mb-4 p-3 rounded-lg border border-green-200 bg-green-50 text-green-800 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full bg-white border-gray-300 focus:border-transparent focus:ring-2"
                style="--tw-ring-color: {{ $purple }};"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="exemple@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full bg-white border-gray-300 focus:border-transparent focus:ring-2"
                style="--tw-ring-color: {{ $orange }};"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember me --}}
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 shadow-sm focus:ring-2"
                       style="accent-color: {{ $purple }};"
                       name="remember">
                <span class="ms-2 text-sm" style="color: {{ $slate }};">
                    Se souvenir de moi
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium underline" style="color: {{ $purple }};"
                   href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        {{-- Submit (gradient like logo) --}}
        <div class="pt-2">
            <button type="submit"
                    class="w-full inline-flex justify-center items-center px-4 py-2 rounded-xl text-sm font-semibold text-white
                           shadow-md hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-offset-2"
                    style="background: {{ $grad }}; --tw-ring-color: {{ $purple }};">
                Se connecter
            </button>
        </div>

        {{-- Register link --}}
        @if (Route::has('register'))
            <p class="text-center text-sm pt-2" style="color: {{ $slate }};">
                Pas de compte ?
                <a href="{{ route('register') }}" class="font-semibold underline" style="color: {{ $purple }};">
                    Créer un compte
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>