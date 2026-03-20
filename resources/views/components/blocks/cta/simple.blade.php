@php
    $locale = app()->getLocale();
    $link = $button_link ?? '#';
    if (!str_starts_with($link, 'http') && str_starts_with($link, '/') && !str_starts_with($link, '/' . $locale)) {
        $link = '/' . $locale . $link;
    } elseif (!str_starts_with($link, 'http') && !str_starts_with($link, '/')) {
        $link = '/' . $locale . '/' . ltrim($link, '/');
    }
@endphp
<div class="cta-section max-w-5xl mx-auto px-4 py-16">
  <div class="bg-gradient-to-r from-indigo-600/90 to-purple-600/90 backdrop-blur-sm rounded-2xl p-12 text-center border border-white/10 shadow-2xl shadow-indigo-500/20">
    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">{{ $title ?? 'Pronto a iniziare?' }}</h2>
    <p class="text-xl max-w-2xl mx-auto mb-8 text-indigo-100">
      {{ $subtitle ?? 'Unisciti alla community e inizia a fare previsioni.' }}
    </p>
    <a href="{{ $link }}" class="inline-flex items-center gap-2 px-10 py-4 bg-white text-indigo-600 hover:bg-indigo-50 font-bold rounded-xl transition-all duration-300 hover:scale-[1.03] hover:shadow-xl">
      {{ $button_text ?? 'Esplora' }}
      <x-heroicon-o-arrow-right class="w-5 h-5" />
    </a>
  </div>
</div>
