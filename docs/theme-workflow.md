# Theme Development & Build Workflow

## Core Philosophy
In the Laraxot ecosystem, themes are modular and isolated. Each theme manages its own assets, dependencies, and build pipeline to ensure maximum flexibility and performance.

## Asset Pipeline Architecture

1.  **Source Assets (`resources/`)**: Uncompiled CSS (Tailwind v4), JS, and images.
2.  **Local Build (`public/`)**: Vite compiles source assets into the theme's local `public` folder, generating a `manifest.json`.
3.  **Distribution (`../../../public_html/themes/{ThemeName}`)**: Compiled assets must be copied to the main application's public root to be accessible by the web server.

## Mandatory Build Procedure

Whenever theme assets are modified or the application reports a `ViteManifestNotFoundException`, follow these steps:

### 1. Environment Requirements
- **Node.js**: >= 20.x (Recommended for Vite 7+ and Tailwind v4)
- **npm**: >= 9.x

### 2. Execution Steps
Navigate to the theme directory:
```bash
cd laravel/Themes/TwentyOne
```

Run the pipeline:
```bash
# 1. Install dependencies
npm install

# 2. Build production assets
npm run build

# 3. Copy to public_html (Requires elevated permissions)
sudo npm run copy
```

## Troubleshooting: ViteManifestNotFoundException

### The "Why"
This error occurs because Laravel's `@vite` directive is configured to look for the manifest in `public_html/themes/TwentyOne/manifest.json`. If this file is missing or the directory is empty, the frontend will fail to render.

### Resolution
The resolution is not just running `npm run build`, but also ensuring `npm run copy` successfully populates the public distribution folder.

## Permissions & Security
The `npm run copy` command interacts with directories outside the `laravel/` root (`public_html`). 
- **Ownership**: Ensure `public_html/themes` is writable by the build user or use `sudo`.
- **Consistency**: Always run `npm run copy` after `npm run build` to keep the distribution in sync.

## Common Pitfalls
- **Node Version**: Running Vite 7 on Node 18 may produce warnings or errors. Always use the project-defined Node version.
- **Manifest Mismatch**: If you change the `statePath` or `public_html` location, update the `copy` script in `package.json`.
- **Global Animation Scripts**: Avoid loading `gsap.min.js` or `scrolltrigger.min.js` as global Blade assets. Keep GSAP in npm + ES module imports (`resources/js/gsap-core.js`, `resources/js/gsap-scroll-trigger.js`) to preserve deterministic Vite bundles.

## Header Navigation Governance

### Philosophy
The header in TwentyOne is CMS-driven and must stay contract-first: the layout calls `<x-section slug="header" />`, and composition is controlled by `config/local/predict/database/content/sections/header.json`.

The design rule is:
- no hardcoded feature button directly inside `components/sections/header.blade.php`;
- each nav feature is a block entry in `header.json`;
- rendering happens through the configured block view.

### Dark Mode UX Decision
For navbar UX, the best pattern is a compact icon toggle (moon/sun) with:
- immediate visual feedback;
- persistent preference (`localStorage`);
- system fallback (`prefers-color-scheme`) when no explicit preference exists.

This keeps the header clean, fast, and predictable across mobile and desktop.

### Implementation Contract
- Header call site: `resources/views/components/layouts/app.blade.php` with `<x-section slug="header" />`.
- Source of truth: `config/local/predict/database/content/sections/header.json`.
- Block view: `pub_theme::components.blocks.ui.dark-mode-toggle`.
- Runtime behavior: `resources/js/dark-mode.js` initialized from `resources/js/app.js`.

### Anti-pattern
- adding dark-mode button markup directly in `components/sections/header.blade.php`;
- using inline scripts inside block Blade for theme switching;
- splitting source-of-truth between JSON and hardcoded Blade.

## Filament 5 Table Widgets - Overview operativo

### Scopo
Il tema non deve "simulare" una tabella con HTML custom quando la feature richiede ricerca, filtri, ordinamento e paginazione. In quel caso la fonte di verita resta un widget tabellare Filament.

### Regola pratica
- se il caso d'uso e tabellare, usare `TableWidget` lato PHP;
- il Blade del tema resta un wrapper visuale (layout, sfondo, spacing), non il motore dati;
- la semantica dati (query, search, filters, sort, pagination) vive nel widget.

### Contratto architetturale tema
1. Il tema monta il widget, non ricostruisce la tabella.
2. Le personalizzazioni UI restano nel CSS del tema e nel wrapper Blade.
3. Le feature tabellari si configurano nel widget Filament (`searchable`, `filters`, `defaultSort`, `paginated`).

### Perche (dry + kiss)
- un solo punto di manutenzione per comportamento tabellare;
- riduzione regressioni tra homepage/list page;
- UI coerente tra card/cella mantenendo la stessa logica applicativa.

### Coerenza sfondo widget predicts
- La pagina `predicts` usa uno sfondo cinematico scuro continuo: il widget tabellare non deve introdurre pannelli opachi.
- Il wrapper visuale `filament-table-widget--sexy` forza trasparenza sui contenitori Filament (`fi-section`, `fi-ta-*`) e mantiene solo micro-elevazione sulle righe.
- La logica dati resta nel widget PHP; il tema governa solo blending, contrasto e motion.

## Predict card hierarchy

### Regola visuale
- La card di listing deve aprire con titolo full-row e subito sotto una scelta primaria evidente.
- L'utente deve capire in meno di un secondo: "di cosa parla il mercato" e "qual e l'esito dominante".

### Regola interazione
- Evitare CTA ridondanti in fondo card quando l'intera card e gia cliccabile.
- Ridurre elementi accessori che interrompono il flusso visivo tra titolo, opzioni e metriche.

### Regola contenuto
- Se manca immagine esito, usare fallback coerente (seed visivo) senza lasciare slot vuoti.
- Se il mercato e multi-esito, comunicarlo con badge semantico (`Multi-esito`) invece di stringhe numeriche poco curate.
