---
title: "log"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "log"
issues: []
discussions: []
status: draft
---

## [2026-10-14] docs | stato del tema provato e ingressi corretti

- Story: [studio e ingressi](../stories/docs-studio-stato-e-ingressi.story.md). TwentyOne non e' il tema di Fixcity (`pub_theme = Sixteen` nei 4 `xra.php`): e' importato dal progetto Predict, 30 occorrenze di `Modules\Predict` in `app/` e `resources/views/`, modulo assente da `laravel/Modules/`.
- `README.md` (struttura, requisiti reali: PHP `^8.4`, Laravel `^13.0`, Filament `^5.0`) e `00-INDEX.md` (stato, classificazione cartelle) corretti; `wiki/index.md`: 4 link ripuntati, 5 annotati.
- Non verificato: da dove si risolva `gsap` (importato ma non in `package.json`).

## [2026-06-30] governance | theme Composer boundary

- Recepita la regola Xot del root Composer skeleton.
- Chiarito che `Themes/*/composer.json` non entra nel merge-plugin root in Predict e che i temi non vanno autoloadati dal root.
- Nuova pagina: `docs/wiki/concepts/theme-composer-boundary.md`.
- Raw note: `docs/raw/notes/theme-composer-boundary-2026-06-30.md`.

## [2026-06-06] architecture | Folio container0 Filament way

- Codice: `[container0]/index` → `container0.index`; `[slug0]/index` → `container0.view` + `@volt`
- Slug0: rimosso `container0.detail`, special-case `predict-view`; usa `ResolvePageAction::pageSlug`
- Doc: `route-names-philosophy.md`, `wiki/concepts/folio-container0-filament-way.md`
- Pest: `tests/Unit/FolioPageMountContractTest.php`

## [2026-06-05] docs | HackerNoon harness — tips 001-022 in wiki locale

- Stub/checklist: second-brain → canon Xot, ai-harness, [hackernoon map](../../../../../docs/wiki/concepts/hackernoon-ai-coding-tips-fixcity-map.md), [llm-wiki.txt](../../../../../bashscripts/tools/prompts/llm-wiki.txt) _(target mancante, verificato 2026-10-14)_
- GitHub: [#272](https://github.com/laraxot/base_fixcity_fila5/issues/272) / [D#273](https://github.com/laraxot/base_fixcity_fila5/discussions/273)

# TwentyOne Wiki Log

## [2026-04-28] governance | recepita regola PHPMD standalone `.phar`
- aggiornato `docs/quality-tools.md` del tema TwentyOne: comando PHPMD portato a `php /home/zorin/.local/bin/phpmd.phar`.
- aggiunto backlink da index locale alla regola root `docs/wiki/concepts/phpmd-standalone-phar-rule.md`.
- chiarito vincolo permanente: nel tema TwentyOne PHPMD non deve rientrare in `composer.json`.

## [2026-04-15] init | wiki bootstrap
- Struttura wiki/log.md inizializzata.
- Layer raw: tutti i file in `docs/` (eccetto `wiki/`).
- Layer wiki: `docs/wiki/` — LLM-maintained, sintesi ad alto riuso.
- Schema: `docs/.schema/WIKI_SCHEMA.md`
- Adozione moduli: `docs/project/llm-wiki-module-adoption.md`

## [2026-04-21] governance | laravel12-lang-path-rule
- Chiarita regola i18n del tema: usare `Themes/TwentyOne/lang/{locale}/...`.
- Esplicitato che `resources/lang/` non è il path standard corrente del progetto Laravel 12.
- Aggiunta pagina: `concepts/laravel12-lang-path-rule.md`.
