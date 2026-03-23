<?php
use function Laravel\Folio\name;

name('home');
?>
<x-layouts.app
    title="Prevedi il Futuro"
    meta-description="La piattaforma di prediction market dove le tue previsioni contano."
>
    <div>
        {{-- 
          ✅ CORRETTO: CMS JSON-based, theme-agnostic
          
          Pattern: <x-page side="content" slug="{slug}" />
          - Il CMS JSON (config/local/predict/database/content/pages/home.json) 
            definisce i blocchi da renderizzare
          - Il theme fornisce il layout (x-layouts.app)
          - Il modulo fornisce i components/blocks
          
          Zen Architecture:
          - Theme = vestito (controlla layout, UI)
          - Module = logica (fornisce dati, components)
          - CMS JSON = configurazione (definisce blocchi, ordine, settings)
          
          NO a:
          - @include('pub_theme::home') ← hardcoded, non modulare
          - Logica di business nel blade ← va nei components del modulo
          - Dati hardcoded ← tutto dal DB
        --}}
        <x-page side="content" slug="home"  />
    </div>
</x-layouts.app>
