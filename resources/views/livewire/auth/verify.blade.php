@section('title', 'Verifica il tuo indirizzo email')

@php
    $particlesColor = 'rgba(125,211,252,0.35)';
@endphp

<div class="antigravity-field relative min-h-screen overflow-hidden bg-slate-950 text-white" data-antigravity-field>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.24),_transparent_30%),radial-gradient(circle_at_80%_30%,_rgba(99,102,241,0.22),_transparent_26%),linear-gradient(180deg,_#020617_0%,_#0f172a_55%,_#111827_100%)]"></div>
    <div class="absolute inset-0 opacity-40">
        <div class="absolute -left-24 top-24 h-72 w-72 rounded-full bg-sky-400/15 blur-3xl"></div>
        <div class="absolute right-0 top-0 h-80 w-80 rounded-full bg-indigo-500/15 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 h-64 w-64 rounded-full bg-cyan-300/10 blur-3xl"></div>
    </div>
    <div class="absolute inset-0 bg-[linear-gradient(rgba(148,163,184,0.06)_1px,transparent_1px),linear-gradient(90deg,rgba(148,163,184,0.06)_1px,transparent_1px)] bg-[size:48px_48px] opacity-20"></div>
    <x-ui.particles count="72" :color="$particlesColor" size="3px" zIndex="0" />
    <div class="antigravity-grid" aria-hidden="true"></div>
    <div class="antigravity-spotlight" aria-hidden="true"></div>
    <div class="antigravity-orb antigravity-orb-1" aria-hidden="true"></div>
    <div class="antigravity-orb antigravity-orb-2" aria-hidden="true"></div>
    <div class="antigravity-orb antigravity-orb-3" aria-hidden="true"></div>

    <main class="relative z-10">
        <div class="mx-auto flex min-h-screen max-w-7xl items-center px-5 py-14 sm:px-8 lg:px-10">
            <div class="grid w-full gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:gap-14">
                <section class="flex flex-col justify-between">
                    <div class="space-y-8">
                        <a href="{{ url('/' . app()->getLocale()) }}" class="inline-flex items-center gap-3 text-white/90 transition hover:text-white">
                            <img src="{{ asset('assets/predict/img/logo-ft.svg') }}" alt="{{ config('app.name') }}" class="h-8 w-auto" />
                            <span class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-300">Predict</span>
                        </a>

                        <div class="space-y-6">
                            <div class="inline-flex items-center gap-2 rounded-full border border-sky-300/20 bg-sky-400/10 px-4 py-2 text-sm font-semibold text-sky-100">
                                <span class="h-2.5 w-2.5 rounded-full bg-emerald-400 shadow-[0_0_24px_rgba(52,211,153,0.9)]"></span>
                                <span>Quasi pronto</span>
                            </div>

                            <div class="space-y-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.32em] text-slate-300">Verifica account</p>
                                <h1 class="max-w-3xl text-5xl font-black leading-[0.95] text-white sm:text-6xl xl:text-7xl">
                                    Conferma la tua email e sblocca l&apos;esperienza Predict
                                </h1>
                                <p class="max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                                    Questa schermata usa un linguaggio visivo cinematico: profondità, glow e particelle leggere per dare senso di avanzamento senza trasformare il percorso auth in un luna park.
                                </p>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-3">
                            <div class="card-kinetic rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur-md">
                                <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-400/10 text-sky-200">
                                    <x-filament::icon icon="heroicon-o-envelope" class="h-6 w-6" />
                                </div>
                                <h2 class="text-base font-bold text-white">1. Controlla la casella</h2>
                                <p class="mt-2 text-sm leading-6 text-slate-300">Apri il messaggio inviato al tuo indirizzo e cerca il link di verifica.</p>
                            </div>
                            <div class="card-kinetic rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur-md">
                                <div class="mb-3 inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-ind
