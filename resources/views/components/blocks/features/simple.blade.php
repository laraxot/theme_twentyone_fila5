<div class="features-section max-w-7xl mx-auto px-4 py-20">
  <div class="text-center mb-16">
    <h2 class="text-4xl md:text-5xl font-black text-white mb-4">
      Come <span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">Funziona</span>
    </h2>
    <p class="text-xl text-slate-400 max-w-2xl mx-auto">Prevedere il futuro non è mai stato così semplice</p>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($items ?? [] as $item)
    <div class="group relative bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:border-indigo-400/50 transition-all duration-300 hover:scale-[1.02]">
      <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500/30 to-blue-500/30 flex items-center justify-center mb-6 group-hover:from-indigo-500/50 group-hover:to-blue-500/50 transition-all">
        <x-filament::icon :icon="$item['icon'] ?? 'heroicon-o-sparkles'" class="w-8 h-8 text-indigo-400" />
      </div>
      <h3 class="text-xl font-bold mb-3 text-white">{{ $item['title'] ?? '' }}</h3>
      <p class="text-slate-400 leading-relaxed">{{ $item['description'] ?? '' }}</p>
    </div>
    @endforeach
  </div>
</div>
