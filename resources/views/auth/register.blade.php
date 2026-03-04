<x-guest-layout>
    @php
        $orange = '#e7522e';
        $purple = '#400eb3';
        $slate  = '#5f6b73';
    @endphp

    <x-slot name="header">
        <h1 class="text-2xl font-bold" style="color: {{ $purple }};">Créer un compte</h1>
        <p class="mt-2 text-sm" style="color: {{ $slate }};">
            Rejoignez vos colocataires dès aujourd’hui.
        </p>
    </x-slot>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full"
                          type="text" name="name" :value="old('name')"
                          required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email" :value="old('email')"
                          required placeholder="exemple@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password"
                          required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password" name="password_confirmation"
                          required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2 flex items-center justify-between">
            <a class="text-sm font-medium underline" style="color: {{ $slate }};"
               href="{{ route('login') }}">
                Déjà inscrit ?
            </a>

            <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 rounded-lg font-semibold text-xs uppercase tracking-widest text-white"
                    style="background-color: {{ $purple }};">
                Créer mon compte
            </button>
        </div>
    </form>
</x-guest-layout>