# 🧠 THEME PHILOSOPHY & ZEN

**Data**: 2026-03-20  
**Stato**: ✅ OBBLIGATORIO  
**Priorità**: CRITICAL

---

## 🎯 FILOSOFIA DEL TEMA

### Il Ruolo del Theme

> **"Il Theme è il VESTITO, non il CORPO"**

**Cosa fa il Theme**:
- ✅ Layout (`app.blade.php`)
- ✅ CSS (Tailwind, animazioni, particles)
- ✅ Pages (Folio + Volt routing)
- ✅ Components estetici (hero, footer, trust bar)

**Cosa NON fa il Theme**:
- ❌ Logica di business
- ❌ Query al database
- ❌ Modelli Eloquent
- ❌ Azioni complesse

---

## 📜 I 7 COMANDAMENTI DEL TEMA

### 1. ❌ NON CREARE PAGINE SPECIFICHE PER CONTENUTO (ZEN NAKED PAGE)

**SBAGLIATO**:
```
Themes/TwentyOne/resources/views/pages/it/predicts/index.blade.php
Themes/TwentyOne/resources/views/pages/it/blog/index.blade.php
Themes/TwentyOne/resources/views/pages/en/predicts/index.blade.php
```

**CORRETTO**:
```
Themes/TwentyOne/resources/views/pages/[container0]/index.blade.php
```

**SPIEGAZIONE**:

Il file `[container0]/index.blade.php` è **GENERICO** e segue la **Zen Naked Page Philosophy**:
- `/it/predicts` → `container0="predicts"`
- `/it/blog` → `container0="blog"`

**PERCHÉ**:
- **DRY (Don't Repeat Yourself)**: 1 file invece di 100
- **Agnosticismo**: Il theme non sa quale contenuto mostra
- **Naked Wrapper**: Il wrapper deve essere un `<div>` nudo senza styling per permettere al CMS di controllare il layout (full-width, cinematic).

**Esempio**:

```php
// [container0]/index.blade.php
// ... Volt logic ...
?>

<x-layouts.app>
    @volt('container0.list')
    <div>
        <x-page side="content" :slug="$container0" :data="$data" />
    </div>
    @endvolt
</x-layouts.app>
```

**Nota**: `ResolvePageAction` è **agnostico** - non sa se sta risolvendo `predicts`, `blog`, o `events`.

---

### 2. ❌ NON USARE @include PER CMS

**SBAGLIATO**:
```blade
@include('pub_theme::home')
```

**CORRETTO**:
```blade
<x-page side="content" slug="home" />
```

**PERCHÉ**:

`@include` è:
- ❌ Hardcoded
- ❌ Non modulare
- ❌ Non configurabile da back office
- ❌ Non riusabile

`<x-page>` è:
- ✅ CMS-driven (JSON)
- ✅ Modulare (blocchi)
- ✅ Configurabile da Filament Builder
- ✅ Riusabile (stesso slug, theme diversi)

**Esempio**:

```blade
// Themes/TwentyOne/resources/views/pages/index.blade.php
<x-layouts.app>
    @volt('home')
    <div>
        <x-page side="content" slug="home" />
    </div>
    @endvolt
</x-layouts.app>
```

Il JSON `config/local/predict/database/content/pages/home.json` definisce:
```json
{
    "content_blocks": {
        "it": [
            {
                "type": "hero",
                "enabled": true,
                "order": 1,
                "data": {
                    "view": "pub_theme::components.blocks.hero.cinematic"
                }
            },
            {
                "type": "widget",
                "enabled": true,
                "order": 5,
                "data": {
                    "view": "pub_theme::filament.widgets.featured-predicts",
                    "widget": "Modules\\Predict\\Filament\\Widgets\\FeaturedPredictsWidget"
                }
            }
        ]
    }
}
```

---

### 3. ❌ NON METTERE LOGICA NEL BLADE

**SBAGLIATO**:
```blade
@php
    $users = \Modules\Xot\Datas\XotData::make()->getUserClass()::count();
    $predicts = \Modules\Predict\Models\Predict::count();
@endphp

<div>
    <p>Utenti: {{ $users }}</p>
    <p>Predict: {{ $predicts }}</p>
</div>
```

**CORRETTO**:

```php
// Modules/UI/app/Actions/GetHomepageStatsAction.php
class GetHomepageStatsAction {
    public function execute(): array {
        $userClass = XotData::make()->getUserClass();
        
        return [
            'users' => $userClass::count(),
            'predicts' => Predict::count(),
            'transactions' => Transaction::sum('amount'),
        ];
    }
}
```

```blade
// Components/blocks/home/stats.blade.php
<div>
    <p>Utenti: {{ $stats['users'] }}</p>
    <p>Predict: {{ $stats['predicts'] }}</p>
</div>
```

**PERCHÉ**:
- Blade = **solo presentazione** (HTML, CSS)
- Action = **logica** (query, calcoli)
- Component = **riceve dati** (props)

---

### 4. ❌ NON USARE FOREACH PER LISTE

**SBAGLIATO**:
```blade
@foreach($predicts as $predict)
    <x-predict.card :predict="$predict" />
@endforeach
```

**CORRETTO**:
```blade
@livewire(\Modules\Predict\Filament\Widgets\PredictTableWidget::class)
```

**PERCHÉ**:

`foreach` nel blade:
- ❌ Logica nel blade
- ❌ NO search automatica
- ❌ NO filters automatici
- ❌ NO sorting automatico
- ❌ NO pagination automatica
- ❌ NO bulk actions
- ❌ NO export

`Filament Widget`:
- ✅ Search (debounce 400ms)
- ✅ Filters (dropdown, select, date)
- ✅ Sorting (multi-column)
- ✅ Pagination (12/24/48)
- ✅ Bulk Actions
- ✅ Export
- ✅ Accessibility (WCAG 2.2 AA)
- ✅ Mobile Responsive
- ✅ Livewire Reactivity
- ✅ URL Sync

---

### 5. ❌ NON USARE EMOJI

**SBAGLIATO**:
```blade
<span>⚽️ Sport</span>
<span>🏛️ Politica</span>
<span>📊 Economia</span>
<span>🎵 Musica</span>
```

**CORRETTO**:
```blade
<div class="flex items-center gap-2">
    <x-filament::icon icon="heroicon-o-trophy" class="w-6 h-6" />
    <span>Sport</span>
</div>

<div class="flex items-center gap-2">
    <x-filament::icon icon="heroicon-o-building-office-2" class="w-6 h-6" />
    <span>Politica</span>
</div>

<div class="flex items-center gap-2">
    <x-filament::icon icon="heroicon-o-chart-bar" class="w-6 h-6" />
    <span>Economia</span>
</div>

<div class="flex items-center gap-2">
    <x-filament::icon icon="heroicon-o-musical-note" class="w-6 h-6" />
    <span>Musica</span>
</div>
```

**PERCHÉ**:
- Emoji = non accessibili (screen reader non li legge bene)
- Emoji = non stilizzabili (non puoi cambiare colore, dimensione)
- Emoji = non themed (non si adattano al design system)
- SVG = accessibili (ARIA labels)
- SVG = stilizzabili (Tailwind classes)
- SVG = themed (design system)

**Icone**:
- Sport: `heroicon-o-trophy`
- Politica: `heroicon-o-building-office-2`
- Economia: `heroicon-o-chart-bar`
- Musica: `heroicon-o-musical-note`
- Tech: `heroicon-o-cpu-chip`
- Cinema: `heroicon-o-film`

---

### 6. ❌ NON USARE /tmp

**SBAGLIATO**:
```php
file_put_contents('/tmp/screenshot.png', $content);
$screenshot = file_get_contents('/tmp/screenshot.png');
```

**CORRETTO**:
```php
// Per screenshot temporanei (test)
file_put_contents(base_path('tests/temp/screenshot.png'), $content);

// Per screenshot permanenti (docs)
file_put_contents(theme_path('docs/screenshots/screenshot.png'), $content);

// Per file temporanei (app)
file_put_contents(storage_path('app/temp/screenshot.png'), $content);
```

**PERCHÉ**:
- `/tmp` = cancellato dal sistema operativo (non portabile)
- `/tmp` = non versionato (Git non lo traccia)
- `storage_path()` = Laravel standard
- `base_path('tests/temp/')` = per test, cancellato dopo
- `theme_path('docs/screenshots/')` = per screenshot, versionato

---

### 7. ❌ NON USARE @push('styles')

**SBAGLIATO**:
```blade
@push('styles')
    <style>
        .hero { background: linear-gradient(...) }
    </style>
@endpush
```

**CORRETTO**:
```blade
{{-- CSS in file dedicato --}}
{{-- Themes/TwentyOne/resources/css/components/hero.css --}}
.hero {
    background: linear-gradient(to bottom right, #0a0e1a, #1a1f3a);
}
```

```php
// Themes/TwentyOne/resources/css/app.css
@import 'components/hero.css';
```

**ECCEZIONI** (solo in casi estremi):
1. **Critical CSS** per LCP (max 14KB)
2. **Testing temporaneo** (solo local, non commitare)

**PERCHÉ**:
- `@push('styles')` = CSS inline (non cacheable)
- `@push('styles')` = non versionato bene
- File dedicati = cacheable, versionato, manutenibile

---

## 🧘 ZEN ARCHITECTURE

### Theme Layer

```
Themes/TwentyOne/
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php          ← Layout principale
│   ├── pages/
│   │   ├── index.blade.php        ← Homepage (Folio + Volt)
│   │   ├── [container0]/
│   │   │   ├── index.blade.php    ← Generic list (AGNOSTICO)
│   │   │   └── [slug0]/
│   │   │       └── index.blade.php ← Generic detail (AGNOSTICO)
│   │   └── auth/
│   │       ├── login.blade.php    ← Login (Folio + Volt)
│   │       └── register.blade.php ← Register (Folio + Volt)
│   ├── livewire/
│   │   ├── predict-card.blade.php ← Reusable component
│   │   └── market-stats.blade.php ← Reusable component
│   └── filament/
│       └── widgets/
│           ├── featured-predicts.blade.php ← Widget view
│           └── predict-table.blade.php ← Widget view
├── resources/css/
│   ├── app.css                    ← Tailwind + custom
│   └── components/
│       ├── hero.css
│       └── predict-card.css
└── docs/
    ├── THEME_PHILOSOPHY_ZEN.md    ← Questo file
    └── DESIGN_SYSTEM.md
```

### Module Layer

```
Modules/Predict/
├── app/
│   ├── Models/
│   │   └── Predict.php
│   ├── Actions/
│   │   ├── ResolvePredictAction.php
│   │   └── CalculatePredictStatsAction.php
│   └── Filament/
│       └── Widgets/
│           ├── FeaturedPredictsWidget.php
│           └── PredictTableWidget.php
├── resources/views/
│   ├── components/
│   │   └── predict/
│   │       ├── card.blade.php
│   │       └── list.blade.php
│   └── blocks/
│       └── home/
│           ├── hero.blade.php
│           └── stats.blade.php
└── docs/
    └── ARCHITECTURE_PHILOSOPHY_ZEN.md
```

### CMS JSON Layer

```
config/local/predict/database/content/pages/
├── home.json
├── predicts.index.json
└── predicts.detail.json
```

---

## 📋 CHECKLIST CODE REVIEW (THEME)

Prima di commitare un file del theme:

### Architecture
- [ ] ✅ Sto usando `[container0]/index.blade.php` (NON `it/predicts/index.blade.php`)?
- [ ] ✅ Sto usando `<x-page slug="home" />` (NON `@include`)?
- [ ] ✅ NO logica di business nel blade?
- [ ] ✅ NO foreach per liste (uso Filament Widget)?
- [ ] ✅ NO emoji (uso SVG)?
- [ ] ✅ NO `/tmp` (uso `storage_path()`)?
- [ ] ✅ NO `@push('styles')` (uso file CSS dedicati)?

### Naming
- [ ] ✅ Traduzioni: `pub_theme::home.hero.title.label` (5 livelli)?
- [ ] ✅ View namespace: `pub_theme::components.blocks.hero`?
- [ ] ✅ File CSS: `resources/css/components/hero.css`?

### Quality
- [ ] ✅ NO query dirette nel blade?
- [ ] ✅ NO `@php` blocks con logica?
- [ ] ✅ Solo HTML, CSS, traduzioni nel blade?

---

## 📚 RIFERIMENTI

### Documentazione
- **Theme Philosophy**: `Themes/TwentyOne/docs/THEME_PHILOSOPHY_ZEN.md`
- **Zen Naked Page**: `Themes/TwentyOne/docs/ZEN_NAKED_PAGE_PHILOSOPHY.md`
- **Module Philosophy**: `Modules/Predict/docs/ARCHITECTURE_PHILOSOPHY_ZEN.md`
- **Architecture Zen**: `docs/project/ARCHITECTURE_ZEN.md`
- **Volt Components**: `docs/project/VOLT_CLASS_BASED_COMPONENTS.md`
- **Filament Widget Transparent Background**: `docs/project/FILAMENT_WIDGET_TRANSPARENT_BACKGROUND.md`
- **Filament Table Widget Background Policy**: `Modules/Predict/docs/FILAMENT_TABLE_WIDGET_BACKGROUND_POLICY.md`
- **Page Coherence Policy**: `Modules/Predict/docs/PAGE_COHERENCE_POLICY.md`

### Esterni
- **Laravel Folio**: https://github.com/laravel/folio
- **Livewire Volt**: https://livewire.laravel.com/docs/volt
- **Filament**: https://filamentphp.com/docs/

---

**Ultimo Aggiornamento**: 2026-03-23  
**Stato**: ✅ OBBLIGATORIO  
**Enforcement**: Code Review + Pre-commit Hook
