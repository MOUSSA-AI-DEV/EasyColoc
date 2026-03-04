<x-app-layout>

    <div class="max-w-3xl mx-auto">
        {{-- Gradient frame --}}
        <div class="rounded-2xl shadow-xl overflow-hidden relative">
            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-lime-600 to-orange-500 opacity-95"></div>

            {{-- Inner surface --}}
            <div class="relative m-1 rounded-2xl border border-white/30 bg-white">
                <div class="p-6 sm:p-8 lg:p-[3%]">
                    <form method="POST" action="{{ route('colocations.store') }}" class="space-y-6">
                        @csrf

                        {{-- Title --}}
                        <div>
                            <label for="title" class="block text-sm font-semibold text-slate-700">
                                Titre
                            </label>

                            <input id="title" name="title" type="text" value="{{ old('title') }}" required
                                placeholder="Ex: Coloc Centre-Ville"
                                class="mt-2 block w-full rounded-xl border border-gray-300/70
                                       placeholder:text-gray-400 focus:border-lime-500 focus:ring-2 focus:ring-lime-500/20 bg-gray-50/50" />

                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-2">
                            <a href="{{ route('colocations.index') }}"
                                class="inline-flex justify-center px-4 py-2 rounded-xl text-sm font-semibold
                                      border border-gray-200 hover:bg-gray-50 text-slate-700">
                                Annuler
                            </a>

                            <button type="submit"
                                class="inline-flex justify-center px-5 py-2 rounded-xl text-sm font-semibold text-white
                                           shadow-md hover:opacity-95 focus:outline-none focus:ring-2 focus:ring-offset-2 bg-gradient-to-r from-lime-600 to-orange-500 ring-lime-500">
                                Créer la colocation
                            </button>
                        </div>

                        <p class="text-xs pt-1 text-slate-500">
                            Vous pourrez ensuite inviter des membres via un lien/token.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
