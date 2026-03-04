<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Reputation Card -->
        <div
            class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-6 text-white shadow-lg transform hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-bold uppercase tracking-wider opacity-80">Reputation</span>
            </div>
            <div class="text-3xl font-black mb-1">{{ auth()->user()->reputation ?? 0 }}</div>
            <div class="text-sm font-medium opacity-80 decoration-indigo-200">User Performance Score</div>
        </div>

        <!-- Paid Payments Card -->
        <div
            class="bg-gradient-to-br from-emerald-400 to-teal-500 rounded-3xl p-6 text-white shadow-lg transform hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-bold uppercase tracking-wider opacity-80">Paid</span>
            </div>
            <div class="text-3xl font-black mb-1">{{ number_format($paymentPaied, 2) }} DH</div>
            <div class="text-sm font-medium opacity-80">Total Settled Amount</div>
        </div>

        <!-- Unpaid Payments Card -->
        <div
            class="bg-gradient-to-br from-orange-400 to-rose-500 rounded-3xl p-6 text-white shadow-lg transform hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-bold uppercase tracking-wider opacity-80">Pending</span>
            </div>
            <div class="text-3xl font-black mb-1">{{ number_format($paymentNotPaied, 2) }} DH</div>
            <div class="text-sm font-medium opacity-80">Remaining to Pay</div>
        </div>
    </div>

    @if ($colocation)
        @include('colocation._detail')
    @else
        <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-slate-100">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">No Active Colocation</h3>
            <p class="text-slate-500 font-medium max-w-sm mx-auto">You are not currently part of any active colocation.
                Join or create a group to start coordinating your dance studio activities.</p>
        </div>
    @endif
</x-app-layout>
