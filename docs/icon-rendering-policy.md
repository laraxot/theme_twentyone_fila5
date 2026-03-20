# TwentyOne Icon Rendering Policy

Il tema `TwentyOne` segue la policy globale di rendering icone:

- preferire `<x-filament::icon>`
- usare `<x-filament::icon-button>` per bottoni icona
- usare `@svg(...)` per icone custom registrate del progetto
- non usare `<x-heroicon-o-...>` quando il nome icona arriva da DB, JSON CMS o array runtime
- normalizzare sempre alias legacy/non validi prima del render (`cpu` → `cpu-chip`, `chart-bar-square`, `status-online`, `collection`)

## Applicazione pratica

Nel blocco `features/simple.blade.php` la renderizzazione e' stata riallineata a:

```blade
<x-filament::icon :icon="$item['icon']" class="w-8 h-8 text-indigo-400" />
```

Questo evita pattern alternativi non necessari come `x-dynamic-component` per icone standard.

## Governance errori reali

Il front office Predict ha gia' mostrato errori Blade come:

- `Unable to locate a class or view for component [heroicon-o-cpu]` — risolto mappando `cpu` → `cpu-chip` in home.blade.php, mega_credentials.blade.php, headernav/markets.blade.php
- alias non validi tipo `heroicon-o-chart-bar-square`

Per evitarli:

- se l'icona e' dinamica, costruire il nome finale con `<x-filament::icon :icon=\"...\" />`
- mappare gli alias legacy verso icone esistenti prima del render
- usare tag diretti `<x-heroicon-o-...>` solo con nomi statici e verificati
