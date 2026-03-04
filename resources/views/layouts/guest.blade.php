<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
@php
    $accent = '#e7522e';
    $teal = '#0f766e';
    $slate  = '#5f6b73';

    // Soft surfaces (less white)
    $surface = '#f6f5fb';      // card background (off-white)
    $inputBg = '#f1f0f8';      // input background (soft)
@endphp

<div class="min-h-screen px-4 pt-4 pb-6 bg-gradient-to-b from-[#f6f7fb] via-[#f3f4f8] to-[#eef0f6]">
    <div class="max-w-6xl mx-auto min-h-screen flex items-center">
        <div class="w-full grid lg:grid-cols-2 gap-10 items-center">

            {{-- LEFT (55%) --}}
            <div class="hidden lg:block">
                <a href="/" class="inline-flex items-center gap-3 mb-6">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-white font-bold text-lg shadow-md"
                         style="background: linear-gradient(135deg, {{ $teal }}, {{ $accent }});">
                        EC
                    </div>
                    <span class="text-3xl font-extrabold" style="color: {{ $teal }};">EasyColoc</span>
                </a>

                <h2 class="text-3xl font-bold leading-tight">
                    Gérez votre colocation sans calculs manuels.
                </h2>

                <p class="mt-3 text-base" style="color: {{ $slate }};">
                    Dépenses partagées, dettes automatiques, et une vue claire de
                    <strong>qui doit quoi à qui</strong>.
                </p>

                {{-- illustration block --}}
                <div class="mt-8 rounded-3xl p-6 border border-gray-200/70 bg-white/60 backdrop-blur shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold" style="color: {{ $teal }};">Deux colocataires</span>
                        <span class="text-xs px-2 py-1 rounded-full"
                              style="background: {{ $accent }}15; color: {{ $accent }};">
                            Exemple
                        </span>
                    </div>

                    <svg viewBox="0 0 640 360" class="w-full h-auto" aria-hidden="true">
                        <defs>
                            <linearGradient id="bgGrad" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="{{ $teal }}" stop-opacity="0.10"/>
                                <stop offset="1" stop-color="{{ $accent }}" stop-opacity="0.10"/>
                            </linearGradient>
                            <linearGradient id="badgeGrad" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="{{ $teal }}"/>
                                <stop offset="1" stop-color="{{ $accent }}"/>
                            </linearGradient>
                        </defs>
                        <rect x="0" y="0" width="640" height="360" rx="24" fill="url(#bgGrad)"/>

                        <path d="M120 170 L320 70 L520 170" fill="none" stroke="{{ $slate }}" stroke-opacity="0.35" stroke-width="10" stroke-linecap="round" />
                        <rect x="170" y="170" width="300" height="150" rx="18" fill="#ffffff" fill-opacity="0.75" stroke="{{ $slate }}" stroke-opacity="0.25" stroke-width="4"/>
                        <rect x="295" y="220" width="50" height="100" rx="10" fill="#ffffff" stroke="{{ $slate }}" stroke-opacity="0.25" stroke-width="4"/>

                        <circle cx="250" cy="210" r="26" fill="{{ $teal }}" fill-opacity="0.18" stroke="{{ $teal }}" stroke-opacity="0.35" stroke-width="4"/>
                        <path d="M210 305c10-40 70-40 80 0" fill="{{ $teal }}" fill-opacity="0.14" stroke="{{ $teal }}" stroke-opacity="0.30" stroke-width="4" stroke-linecap="round"/>

                        <circle cx="390" cy="210" r="26" fill="{{ $accent }}" fill-opacity="0.18" stroke="{{ $accent }}" stroke-opacity="0.35" stroke-width="4"/>
                        <path d="M350 305c10-40 70-40 80 0" fill="{{ $accent }}" fill-opacity="0.14" stroke="{{ $accent }}" stroke-opacity="0.30" stroke-width="4" stroke-linecap="round"/>

                        <rect x="270" y="110" width="100" height="46" rx="14" fill="url(#badgeGrad)"/>
                        <text x="320" y="140" text-anchor="middle" font-size="16" font-weight="700" fill="#fff">COLLOC</text>
                    </svg>

                    <div class="mt-4 text-sm" style="color: {{ $slate }};">
                        Invitations • Dépenses • Remboursements simplifiés
                    </div>
                </div>
            </div>

            {{-- RIGHT (45%) --}}
            <div class="w-full flex justify-center lg:justify-end">
                <div class="w-full lg:w-[45%] lg:min-w-[420px] lg:max-w-[520px]">
                    {{-- Gradient frame --}}
                    <div class="rounded-2xl shadow-2xl overflow-hidden relative">
                        <div class="absolute inset-0 rounded-2xl"
                             style="background: linear-gradient(135deg, {{ $teal }}, {{ $accent }}); opacity: 0.95;"></div>

                        {{-- inner surface (NOT white) --}}
                        <div class="relative m-1 rounded-2xl px-6 py-8 sm:px-10 sm:py-10 border border-white/30"
                             style="background: {{ $surface }};">
                            @isset($header)
                                <div class="text-center mb-6">
                                    {{ $header }}
                                </div>
                            @endisset

                            {{-- pass colors to children (optional use) --}}
                            <div
                                data-orange="{{ $accent }}"
                                data-teal="{{ $teal }}"
                                data-slate="{{ $slate }}"
                                data-inputbg="{{ $inputBg }}"
                            >
                                {{ $slot }}
                            </div>
                        </div>
                    </div>

                    <p class="mt-6 text-center text-sm font-medium" style="color: {{ $slate }};">
                        © {{ date('Y') }} EasyColoc
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>