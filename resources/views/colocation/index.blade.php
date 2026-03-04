<x-app-layout>
    @if (session('success'))
        <div
            class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-900/40 dark:bg-green-900/20 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div
        class="bg-white shadow-sm rounded-xl border border-gray-200/70 overflow-hidden">
        <div class="p-4 sm:p-6">
            @if ($colocations->isEmpty())
                <div class="text-sm text-gray-600">
                    Aucune colocation trouvée. Créez-en une pour commencer.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($colocations as $colocation)
                        <div
                            class="bg-gray-50 rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow duration-300 flex flex-col">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-900 line-clamp-2 pr-4">
                                    {{ $colocation->title }}
                                </h3>
                                <span
                                    class="shrink-0 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $colocation->status === 'actif'
                                        ? 'bg-green-100 text-green-800 ring-1 ring-inset ring-green-600/20'
                                        : 'bg-gray-100 text-gray-800 ring-1 ring-inset ring-gray-500/20' }}">
                                    {{ ucfirst($colocation->status) }}
                                </span>
                            </div>

                            <div class="space-y-3 mb-6 flex-grow">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 shrink-0 text-indigo-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <span>{{ $colocation->users->count() }} Membre(s)</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-3 shrink-0 text-indigo-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>Créée le {{ $colocation->created_at?->format('d/m/Y') }}</span>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-between mt-auto pt-4 border-t border-gray-200">
                                <a href="{{ route('colocations.show', $colocation) }}"
                                    class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 group">
                                    Détails
                                    <svg class="ml-1 w-4 h-4 transform group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
