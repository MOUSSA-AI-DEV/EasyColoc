@php
    $currentUserPivot = $colocation->users->where('id', auth()->id())->first()?->pivot;
    $isOwner = $currentUserPivot && $currentUserPivot->role === 'owner';
@endphp

<div class="space-y-6">
    <!-- Header & Info -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-200/70 overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $colocation->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Créée le {{ $colocation->created_at?->format('d/m/Y') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $colocation->status === 'actif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($colocation->status) }}
                    </span>

                    @if ($isOwner)
                        @if ($colocation->status === 'actif')
                            <form action="{{ route('colocations.inactif', $colocation) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-sm font-medium text-red-600 hover:text-red-700 bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                    Inactiver
                                </button>
                            </form>
                        @endif
                    @else
                        <form action="{{ route('colocations.leave', $colocation) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-sm font-medium text-orange-600 hover:text-orange-700 bg-orange-50 px-3 py-1.5 rounded-lg transition-colors">
                                Quitter
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Qui doit à qui Section -->
        <div class="lg:col-span-3">
            <div class="bg-white shadow-sm rounded-xl border border-gray-200/70 p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Qui doit à qui
                </h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs uppercase tracking-wider text-gray-500 border-b border-gray-100">
                            <tr>
                                <th class="pb-3 font-semibold">Membre</th>
                                <th class="pb-3 font-semibold">Doit à</th>
                                <th class="pb-3 font-semibold">Pour la dépense</th>
                                <th class="pb-3 font-semibold text-right">Montant</th>
                                <th class="pb-3 font-semibold text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($colocation->payments() as $payment)
                                <tr class="group">
                                    <td class="py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center text-orange-700 font-bold text-[10px] uppercase">
                                                {{ substr($payment->user->name, 0, 2) }}
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $payment->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-[10px] uppercase">
                                                {{ substr($payment->expense->payer->name, 0, 2) }}
                                            </div>
                                            <span class="text-gray-600">{{ $payment->expense->payer->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-gray-500 italic">
                                        {{ $payment->expense->title }}
                                    </td>
                                    <td class="py-4 text-right font-bold text-gray-900">
                                        {{ number_format($payment->amount, 2) }} €
                                    </td>
                                    <td class="py-4 text-right">
                                        @if ($payment->user_id === auth()->id())
                                            <form action="{{ route('payments.markAsPaid', $payment) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-1.5 rounded-lg transition-colors">
                                                    Marqué payé
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[10px] text-gray-400 italic">En attente</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500 italic">Tout est réglé !
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Members Section -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white shadow-sm rounded-xl border border-gray-200/70 p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Membres
                </h4>
                <ul class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($colocation->users as $user)
                        <li class="py-3 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-xs uppercase">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ ucfirst($user->pivot->role) }}</p>
                                </div>
                            </div>
                            @if ($user->pivot->left_at)
                                <span class="text-[10px] bg-red-50 text-red-600 px-1.5 py-0.5 rounded">Parti</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
                @if ($isOwner)
                    <div class="mt-4">
                        <h5 class="text-sm font-medium text-gray-900 mb-2">Inviter des membres</h5>
                        <form action="{{ route('invitations.store', $colocation) }}" method="POST">
                            @csrf
                            <div class="flex gap-2">
                                <input type="email" name="email" required placeholder="Email de l'invité"
                                    class="flex-1 text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <button type="submit"
                                    class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Categories Section (Owner Management) -->
            <div class="bg-white shadow-sm rounded-xl border border-gray-200/70 p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    Catégories
                </h4>

                @if ($isOwner)
                    <form action="{{ route('categories.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                        <div class="flex gap-2">
                            <input type="text" name="title" required placeholder="Nouvelle catégorie"
                                class="flex-1 text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <button type="submit"
                                class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                @endif

                <div class="flex flex-wrap gap-2">
                    @forelse($colocation->categories as $category)
                        <div
                            class="inline-flex items-center bg-gray-50 border border-gray-200 rounded-full px-3 py-1 group">
                            <span class="text-xs font-medium text-gray-700">{{ $category->title }}</span>
                            @if ($isOwner)
                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                    class="ml-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Aucune catégorie.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Expenses Section -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white shadow-sm rounded-xl border border-gray-200/70 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        Dépenses
                    </h4>
                    <button onclick="document.getElementById('expense-form').classList.toggle('hidden')"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-700 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Ajouter une dépense
                    </button>
                </div>

                <!-- Add Expense Form (Hidden by default) -->
                <div id="expense-form"
                    class="hidden mb-8 bg-gray-50 p-4 rounded-xl border border-dashed border-gray-300">
                    <form action="{{ route('expenses.store', $colocation) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="sm:col-span-2 md:col-span-1">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Titre</label>
                                <input type="text" name="title" required
                                    class="w-full text-sm rounded-lg border-gray-300">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Montant
                                    (€)</label>
                                <input type="number" step="0.01" name="amount" required
                                    class="w-full text-sm rounded-lg border-gray-300">
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-semibold text-gray-500 uppercase mb-1">Catégorie</label>
                                <select name="category_id" required class="w-full text-sm rounded-lg border-gray-300">
                                    @foreach ($colocation->categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Date</label>
                                <input type="date" name="date" required value="{{ date('Y-m-d') }}"
                                    class="w-full text-sm rounded-lg border-gray-300">
                            </div>
                            <div class="sm:col-span-2 md:col-span-2 flex items-end">
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors text-sm font-medium">
                                    Enregistrer la dépense
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs uppercase tracking-wider text-gray-500 border-b border-gray-100">
                            <tr>
                                <th class="pb-3 font-semibold">Description</th>
                                <th class="pb-3 font-semibold">Catégorie</th>
                                <th class="pb-3 font-semibold text-right">Montant</th>
                                <th class="pb-3 font-semibold text-center">Payé par</th>
                                <th class="pb-3 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($colocation->expenses->sortByDesc('date') as $expense)
                                <tr class="group">
                                    <td class="py-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $expense->title }}</div>
                                        <div class="text-[10px] text-gray-400">{{ $expense->date?->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <span
                                            class="px-2 py-0.5 rounded-full bg-gray-100 text-[10px]">{{ $expense->category?->title ?? 'N/A' }}</span>
                                    </td>
                                    <td class="py-4 text-right font-bold text-gray-900">
                                        {{ number_format($expense->amount, 2) }} €
                                    </td>
                                    <td class="py-4 text-center">
                                        <div class="text-[10px] text-gray-600">{{ $expense->payer->name }}</div>
                                    </td>
                                    <td class="py-4 text-right">
                                        @if ($expense->payer_id === auth()->id())
                                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST"
                                                onsubmit="return confirm('Supprimer cette dépense ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500 italic">Aucune dépense
                                        enregistrée.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
