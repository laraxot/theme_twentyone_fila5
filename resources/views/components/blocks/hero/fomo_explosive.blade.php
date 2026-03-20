@props([
    'hero_title' => $title ?? 'Trasforma le Tue Previsioni in PROFITTI REALI',
    'hero_subtitle' => $subtitle ?? 'La piattaforma #1 in Italia per trading predittivo',
    'hero_description' => $hero_description ?? 'Investi sulle tue previsioni del futuro e guadagna quando hai ragione. Bitcoin a 100K? Elezioni politiche? Eventi sportivi? Scommettiamo che sai già cosa succederà.',
    'cta_primary' => $cta_primary ?? [
        'text' => 'INIZIA A GUADAGNARE',
        'url' => '/register',
        'class' => 'bg-gradient-to-r from-orange-500 via-red-500 to-pink-500 hover:from-orange-600 hover:via-red-700 hover:to-pink-700 text-white font-black py-5 px-10 rounded-2xl text-xl transform hover:scale-110 hover:-translate-y-1 transition-all duration-500 shadow-2xl hover:shadow-pink-500/50 animate-pulse-slow animate-glow'
    ],
    'cta_secondary' => $cta_secondary ?? [],
    'background_video' => $background_video ?? '',
    'live_users' => $live_users ?? '1,000+ users predicting now',
    'last_big_win' => $last_big_win ?? null,
    'countdown' => $countdown ?? null
])

{{-- CINEMATIC HERO SECTION — Enhanced with advanced animations --}}
<section class="relative min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 via-indigo-900 to-slate-900 overflow-hidden">
    
    {{-- Animated Gradient Background —}}
    <div class="absolute inset-0 z-0 bg-gradient-to-br from-gray-900 via-purple-900 via-indigo-900 to-slate-900 animate-gradient-shift"></div>
    
    {{-- Video Background (if available) —}}
    @if($background_video)
    <div class="absolute inset-0 z-0">
        <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-20">
            <source src="{{ $background_video }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900"></div>
    </div>
    @endif
    
    {{-- Enhanced Particles System —}}
    <div class="absolute inset-0 z-0 overflow-hidden">
        {{-- Floating Orbs —}}
        <div class="cinematic-orb cinematic-orb-1"></div>
        <div class="cinematic-orb cinematic-orb-2"></div>
        <div class="cinematic-orb cinematic-orb-3"></div>
        <div class="cinematic-orb cinematic-orb-4"></div>
        
        {{-- Particle Rain —}}
        <div class="particles-container">
            @for($i = 0; $i < 100; $i++)
            <div class="particle-rain" style="
                left: {{ rand(0, 100) }}%;
                animation-delay: {{ rand(0, 5000) }}ms;
                animation-duration: {{ rand(2000, 6000) }}ms;
                opacity: {{ rand(20, 80) / 100 }};
            "></div>
            @endfor
        </div>
        
        {{-- Grid Lines —}}
        <div class="cinematic-grid"></div>
    </div>
    
    {{-- Scanlines Effect —}}
    <div class="absolute inset-0 z-10 pointer-events-none scanlines-overlay"></div>
    
    {{-- Vignette Effect —}}
    <div class="absolute inset-0 z-10 pointer-events-none vignette-overlay"></div>
    
    {{-- Main Content —}}
    <div class="relative z-20 container mx-auto px-4 pt-24 pb-16">
        
        {{-- Live Users Badge — Enhanced —}}
        <div class="text-center mb-8 animate-fade-in-down">
            <div class="inline-flex items-center bg-gradient-to-r from-green-500/30 to-emerald-500/30 border-2 border-green-400/50 rounded-full px-6 py-3 text-green-300 text-sm font-bold animate-pulse-slow shadow-lg shadow-green-500/30 backdrop-blur-sm">
                <div class="relative">
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-ping absolute"></div>
                    <div class="w-3 h-3 bg-green-400 rounded-full relative"></div>
                </div>
                <span class="ml-3 tracking-wide">{{ $live_users }}</span>
                <div class="ml-3 flex space-x-1">
                    <span class="w-1 h-1 bg-green-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                    <span class="w-1 h-1 bg-green-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                    <span class="w-1 h-1 bg-green-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                </div>
            </div>
        </div>
        
        {{-- Hero Title — Enhanced with Glow —}}
        <div class="text-center mb-10 animate-fade-in-up">
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white mb-6 leading-tight animate-title-glow">
                <span class="bg-gradient-to-r from-yellow-400 via-orange-500 via-red-500 to-pink-500 bg-clip-text text-transparent animate-gradient-flow drop-shadow-2xl">
                    {{ $hero_title }}
                </span>
            </h1>
            <p class="text-2xl md:text-3xl text-gray-200 mb-10 max-w-5xl mx-auto font-light tracking-wide animate-fade-in-up animate-delay-200 drop-shadow-lg">
                {{ $hero_subtitle }}
            </p>
        </div>
        
        {{-- Last Big Win — Enhanced —}}
        @if($last_big_win)
        <div class="bg-gradient-to-r from-green-500/30 via-emerald-500/30 to-teal-500/30 border-2 border-green-400/50 rounded-3xl p-8 mb-10 max-w-3xl mx-auto transform hover:scale-105 hover:-translate-y-2 transition-all duration-500 shadow-2xl shadow-green-500/40 animate-float backdrop-blur-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-5">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center animate-pulse-slow shadow-lg shadow-green-500/50">
                        <svg class="w-8 h-8 text-white animate-spin-slow" fill="currentColor" viewBox="0 0 24 24"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94.63 1.5 1.98 2.63 3.61 2.96V19H7v2h10v-2h-4v-3.1c1.63-.33 2.98-1.46 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2z"/></svg>
                    </div>
                    <div>
                        <div class="text-green-300 font-bold text-xl">{{ $last_big_win['user'] ?? 'Utente' }}</div>
                        <div class="text-gray-300 text-sm">{{ $last_big_win['time'] ?? '' }} • {{ $last_big_win['market'] ?? '' }}</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-5xl font-black text-transparent bg-gradient-to-r from-green-300 to-emerald-400 bg-clip-text animate-pulse-slow">{{ $last_big_win['amount'] ?? '' }}</div>
                    <div class="text-xs text-green-300 font-bold tracking-wider animate-pulse flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172V9.375c0-1.457-.458-2.81-1.257-3.918a7.473 7.473 0 0 0-2.535-2.078M12 3v2.25m0 13.5V21" />
                        </svg>
                        VINCITA EPICA!
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        {{-- CTA Buttons — Enhanced —}}
        <div class="text-center space-y-6 mb-12 animate-fade-in-up animate-delay-400">
            <a href="{{ $cta_primary['url'] ?? '#' }}" class="{{ $cta_primary['class'] }} inline-block relative overflow-hidden group">
                <span class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent transform -skew-x-12 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                <span class="relative z-10 flex items-center space-x-2">
                    <span>{{ $cta_primary['text'] }}</span>
                    <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </span>
            </a>
            @if(isset($cta_secondary['text']))
            <div class="animate-fade-in-up animate-delay-600">
                <a href="{{ $cta_secondary['url'] ?? '#' }}" class="inline-block text-gray-300 hover:text-white font-semibold text-lg underline underline-offset-8 hover:underline-offset-12 transition-all duration-500 hover:text-shadow-glow">{{ $cta_secondary['text'] }}</a>
            </div>
            @endif
        </div>
        
        {{-- Stats — Enhanced —}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-16 animate-fade-in-up animate-delay-800">
            <div class="text-center p-6 bg-gradient-to-br from-green-500/20 to-emerald-500/20 border border-green-400/30 rounded-2xl transform hover:scale-110 hover:-translate-y-2 transition-all duration-500 shadow-xl shadow-green-500/20 backdrop-blur-sm">
                <div class="text-4xl font-black text-transparent bg-gradient-to-r from-green-300 to-emerald-400 bg-clip-text animate-pulse-slow">€2.4M</div>
                <div class="flex items-center justify-center gap-1 text-xs text-green-300 font-bold tracking-wider mt-2">
                <x-filament::icon icon="predict-currency" class="h-3.5 w-3.5" aria-hidden="true" /> PAGATI OGGI
            </div>
            </div>
            <div class="text-center p-6 bg-gradient-to-br from-blue-500/20 to-indigo-500/20 border border-blue-400/30 rounded-2xl transform hover:scale-110 hover:-translate-y-2 transition-all duration-500 shadow-xl shadow-blue-500/20 backdrop-blur-sm">
                <div class="text-4xl font-black text-transparent bg-gradient-to-r from-blue-300 to-indigo-400 bg-clip-text animate-pulse-slow">47K+</div>
                <div class="flex items-center justify-center gap-1 text-xs text-blue-300 font-bold tracking-wider mt-2">
                <x-filament::icon icon="heroicon-o-users" class="h-3.5 w-3.5" aria-hidden="true" /> UTENTI ATTIVI
            </div>
            </div>
            <div class="text-center p-6 bg-gradient-to-br from-purple-500/20 to-pink-500/20 border border-purple-400/30 rounded-2xl transform hover:scale-110 hover:-translate-y-2 transition-all duration-500 shadow-xl shadow-purple-500/20 backdrop-blur-sm">
                <div class="text-4xl font-black text-transparent bg-gradient-to-r from-purple-300 to-pink-400 bg-clip-text animate-pulse-slow">94%</div>
                <div class="flex items-center justify-center gap-1 text-xs text-purple-300 font-bold tracking-wider mt-2">
                <x-filament::icon icon="heroicon-o-flag" class="h-3.5 w-3.5" aria-hidden="true" /> ACCURACY TOP
            </div>
            </div>
        </div>
        
        {{-- Floating Action Buttons (Bottom Right) — Enhanced —}}
        <div class="absolute bottom-10 right-10 space-y-4 hidden lg:block animate-fade-in-right animate-delay-1000">
            <div class="bg-gradient-to-br from-green-500/30 to-emerald-500/30 border-2 border-green-400/50 rounded-full p-5 animate-bounce-slow shadow-2xl shadow-green-500/40 backdrop-blur-sm">
                <svg class="w-8 h-8 text-green-400 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <div class="bg-gradient-to-br from-blue-500/30 to-indigo-500/30 border-2 border-blue-400/50 rounded-full p-5 animate-bounce-slow shadow-2xl shadow-blue-500/40 backdrop-blur-sm" style="animation-delay: 1s">
                <svg class="w-8 h-8 text-blue-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div class="bg-gradient-to-br from-purple-500/30 to-pink-500/30 border-2 border-purple-400/50 rounded-full p-5 animate-bounce-slow shadow-2xl shadow-purple-500/40 backdrop-blur-sm" style="animation-delay: 2s">
                <svg class="w-8 h-8 text-purple-400 animate-ping" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
        </div>
    </div>
    
    {{-- Scroll Indicator — Enhanced —}}
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-fade-in-up animate-delay-1200">
        <div class="flex flex-col items-center space-y-2">
            <span class="text-gray-400 text-sm font-semibold tracking-wider animate-pulse">SCOPRI DI PIÙ</span>
            <div class="w-6 h-10 border-2 border-gray-400 rounded-full flex justify-center p-1">
                <div class="w-1 h-3 bg-gray-400 rounded-full animate-mouse-scroll"></div>
            </div>
        </div>
    </div>
</section>

@once
@push('styles')
<style>
/* ============================================
   CINEMATIC ANIMATIONS — Advanced Effects
   ============================================ */

/* Gradient Shift Animation */
@keyframes gradient-shift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
.animate-gradient-shift {
    background-size: 400% 400%;
    animation: gradient-shift 15s ease infinite;
}

/* Gradient Flow Animation */
@keyframes gradient-flow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
.animate-gradient-flow {
    background-size: 300% 300%;
    animation: gradient-flow 8s ease infinite;
}

/* Title Glow Animation */
@keyframes title-glow {
    0%, 100% { text-shadow: 0 0 20px rgba(255,255,255,0.5), 0 0 40px rgba(255,165,0,0.3); }
    50% { text-shadow: 0 0 40px rgba(255,255,255,0.8), 0 0 80px rgba(255,165,0,0.6); }
}
.animate-title-glow {
    animation: title-glow 3s ease-in-out infinite;
}

/* Pulse Slow Animation */
@keyframes pulse-slow {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(0.98); }
}
.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

/* Glow Animation */
@keyframes glow {
    0%, 100% { box-shadow: 0 0 20px rgba(255,165,0,0.5), 0 0 40px rgba(255,165,0,0.3); }
    50% { box-shadow: 0 0 40px rgba(255,165,0,0.8), 0 0 80px rgba(255,165,0,0.6); }
}
.animate-glow {
    animation: glow 2s ease-in-out infinite;
}

/* Float Animation */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}
.animate-float {
    animation: float 4s ease-in-out infinite;
}

/* Bounce Slow Animation */
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}
.animate-bounce-slow {
    animation: bounce-slow 3s ease-in-out infinite;
}

/* Spin Slow Animation */
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.animate-spin-slow {
    animation: spin-slow 8s linear infinite;
}

/* Mouse Scroll Animation */
@keyframes mouse-scroll {
    0% { transform: translateY(0); opacity: 1; }
    100% { transform: translateY(15px); opacity: 0; }
}
.animate-mouse-scroll {
    animation: mouse-scroll 1.5s ease-in-out infinite;
}

/* Fade In Down Animation */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-down {
    animation: fadeInDown 1s ease-out forwards;
}

/* Fade In Up Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
}

/* Fade In Right Animation */
@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
.animate-fade-in-right {
    animation: fadeInRight 1s ease-out forwards;
}

/* Animation Delays */
.animate-delay-200 { animation-delay: 0.2s; }
.animate-delay-400 { animation-delay: 0.4s; }
.animate-delay-600 { animation-delay: 0.6s; }
.animate-delay-800 { animation-delay: 0.8s; }
.animate-delay-1000 { animation-delay: 1s; }
.animate-delay-1200 { animation-delay: 1.2s; }

/* Text Shadow Glow */
.hover-text-shadow-glow:hover {
    text-shadow: 0 0 10px rgba(255,255,255,0.8), 0 0 20px rgba(255,255,255,0.6), 0 0 30px rgba(255,255,255,0.4);
}

/* Cinematic Orbs */
.cinematic-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.3;
    animation: float 10s ease-in-out infinite;
}
.cinematic-orb-1 {
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(147,51,234,0.4) 0%, transparent 70%);
    top: -100px;
    left: -100px;
    animation-delay: 0s;
}
.cinematic-orb-2 {
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59,130,246,0.4) 0%, transparent 70%);
    bottom: -150px;
    right: -150px;
    animation-delay: 2s;
}
.cinematic-orb-3 {
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(236,72,153,0.4) 0%, transparent 70%);
    top: 50%;
    right: 10%;
    animation-delay: 4s;
}
.cinematic-orb-4 {
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(251,146,60,0.4) 0%, transparent 70%);
    bottom: 20%;
    left: 10%;
    animation-delay: 6s;
}

/* Particle Rain */
.particles-container {
    position: absolute;
    inset: 0;
    overflow: hidden;
}
.particle-rain {
    position: absolute;
    width: 2px;
    height: 2px;
    background: rgba(255,255,255,0.8);
    border-radius: 50%;
    animation: particle-fall linear infinite;
}
@keyframes particle-fall {
    0% {
        transform: translateY(-100vh) scale(0);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(100vh) scale(1);
        opacity: 0;
    }
}

/* Cinematic Grid */
.cinematic-grid {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(rgba(147,51,234,0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(147,51,234,0.1) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: grid-move 20s linear infinite;
    opacity: 0.2;
}
@keyframes grid-move {
    0% { transform: perspective(500px) rotateX(60deg) translateY(0); }
    100% { transform: perspective(500px) rotateX(60deg) translateY(50px); }
}

/* Scanlines Overlay */
.scanlines-overlay {
    background: repeating-linear-gradient(
        0deg,
        rgba(0,0,0,0.15),
        rgba(0,0,0,0.15) 1px,
        transparent 1px,
        transparent 2px
    );
    pointer-events: none;
}

/* Vignette Overlay */
.vignette-overlay {
    background: radial-gradient(ellipse at center, transparent 0%, transparent 50%, rgba(0,0,0,0.6) 100%);
    pointer-events: none;
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
    .cinematic-orb,
    .particle-rain,
    .cinematic-grid {
        display: none;
    }
}
</style>
@endpush
@endonce
    .particles-bg { position: absolute; width: 100%; height: 100%; overflow: hidden; }
    .particle { position: absolute; width: 4px; height: 4px; background: linear-gradient(45deg, #fbbf24, #f59e0b); border-radius: 50%; animation: float linear infinite; }
    @keyframes float { 0% { transform: translateY(100vh) translateX(0px) rotate(0deg); opacity: 1; } 100% { transform: translateY(-10vh) translateX(100px) rotate(360deg); opacity: 0; } }
    .animate-gradient { background-size: 400% 400%; animation: gradient 3s ease infinite; }
    @keyframes gradient { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
</style>
@endpush
@endonce
