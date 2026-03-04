{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyColoc</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">

@php
    $orange = '#e7522e';
    $purple = '#400eb3';
    $slate  = '#5f6b73';
@endphp

<div class="min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <!-- LOGO EASYCOLOC -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold"
                     style="background: linear-gradient(135deg, {{ $purple }}, {{ $orange }});">
                    EC
                </div>

                <span class="text-xl font-bold" style="color: {{ $purple }};">
                    EasyColoc
                </span>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm font-medium rounded-lg border"
                   style="color: {{ $slate }};">
                    Se connecter
                </a>

                <a href="{{ route('register') }}"
                   class="px-4 py-2 text-sm font-medium text-white rounded-lg"
                   style="background: linear-gradient(135deg, #400eb3, #e7522e);;">
                    Créer un compte
                </a>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="flex-1 flex items-center">
        <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">

            <!-- LEFT CONTENT -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Simplifiez la gestion de votre
                    <span style="color: {{ $orange }};">colocation</span>
                </h1>

                <p class="mt-6 text-lg" style="color: {{ $slate }};">
                    EasyColoc vous permet de suivre les dépenses communes et de répartir automatiquement
                    les dettes entre membres pour savoir clairement
                    <strong>« qui doit quoi à qui »</strong>.
                </p>

                <div class="mt-8 flex gap-4">
                    <a href="{{ route('register') }}"
                       class="px-6 py-3 text-white font-semibold rounded-xl shadow"
                       style="background-color: {{ $purple }};">
                        Commencer gratuitement
                    </a>

                    <a href="{{ route('login') }}"
                       class="px-6 py-3 font-semibold rounded-xl border"
                       style="color: {{ $purple }};">
                        J’ai déjà un compte
                    </a>
                </div>
            </div>

            <!-- RIGHT VISUAL CARD -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200">
                <h3 class="text-lg font-semibold mb-4" style="color: {{ $purple }};">
                    Exemple de remboursement
                </h3>

                <div class="space-y-4">

                    <div class="p-4 border rounded-xl">
                        <div class="flex justify-between">
                            <span>Mohammed</span>
                            <span class="font-semibold" style="color: {{ $orange }};">
                                doit 120 MAD
                            </span>
                        </div>
                        <div class="text-sm mt-1" style="color: {{ $slate }};">
                            À payer à Sarah
                        </div>
                    </div>

                    <div class="p-4 border rounded-xl">
                        <div class="flex justify-between">
                            <span>Yassine</span>
                            <span class="font-semibold" style="color: {{ $purple }};">
                                reçoit 85 MAD
                            </span>
                        </div>
                        <div class="text-sm mt-1" style="color: {{ $slate }};">
                            Payé par Mohammed
                        </div>
                    </div>

                </div>

                <button class="mt-6 w-full py-2 text-white font-semibold rounded-lg"
                        style="background-color: {{ $orange }};">
                    Marquer payé
                </button>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-6 py-6 text-sm text-center"
             style="color: {{ $slate }};">
            © {{ date('Y') }} EasyColoc — Application de gestion de colocation
        </div>
    </footer>

</div>
</body>
</html>