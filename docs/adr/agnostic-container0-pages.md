---
title: "ADR — Le pagine Folio di TwentyOne sono due contenitori agnostici: container0.index e container0.view"
type: decision
status: accepted
theme: TwentyOne
created: 2026-11-24
updated: 2026-11-24
related:
  - ../PREDICT_DETAIL_AGNOSTIC_CONTRACT.md
  - ../JSON_ARCHITECTURE.md
---

# ADR: `[container0]` e `[container0]/[slug0]` non conoscono il tipo di contenuto

## Contesto

- Il tema serve elenchi e dettagli di tipi diversi (mercati di previsione, articoli, eventi) con le stesse due pagine
  Folio: `resources/views/pages/[container0]/index.blade.php` e `[container0]/[slug0]/index.blade.php`.
- Versioni precedenti usavano slug diversi per lo stesso ruolo (`container0.list`, `container0.detail`), variabili col nome
  del modulo nel container (`$predict`, `$article`) e logica CMS dentro la pagina (`CmsPage`, `resolveHomeTitle`)
  ([PREDICT_DETAIL_AGNOSTIC_CONTRACT](../PREDICT_DETAIL_AGNOSTIC_CONTRACT.md)).
- Ogni variante obbligava il JSON della pagina (`<container0>.view.json`) a seguire il nome scelto dal singolo file.
- Domanda: come si chiamano rotte, slug CMS e payload delle due pagine generiche?

## Decisione

- Elenco: `name('container0.index')`, `@volt('container0.index')`, `$this->pageSlug = $container0.'.index'`.
- Dettaglio: `name('container0.view')`, `@volt('container0.view')`, risoluzione con `Modules\Cms\Actions\ResolvePageAction`
  e middleware `PageSlugMiddleware`; slug CMS `<container0>.view` (es. `articles.view`).
- Il payload del container e' neutro (`item`, `record`); i blocchi del JSON leggono da li'. Gli alias col nome del modulo
  sono solo compatibilita' in uscita.
- `mount()` lineare nella classe Volt, nessuna query di dominio nella pagina.

## Alternative scartate

- **Una pagina Folio per tipo** (`pages/predicts/[slug].blade.php`): duplica la pagina per ogni modulo e lega il tema ai
  moduli installati.
- **Slug liberi per pagina** (`.list`, `.detail`, `.show`): i JSON e i link non sanno quale aspettarsi.
- **Variabili col nome del modulo** (`$predict`): il container smette di essere riusabile per un altro tipo.

## Conseguenze

- Pro: un tipo nuovo si aggiunge con due JSON (`<tipo>.index.json`, `<tipo>.view.json`), senza toccare il tema.
- Contro: i blocchi del dettaglio devono saper leggere `item`/`record` generici.
- Debito: le Action `app/Actions/Hero` e `app/Actions/Markets` e diversi blocchi nominano ancora `Modules\Predict`
  (vedi [contratti](../contracts/README.md)).

## Verifica

`Themes/TwentyOne/tests/Unit/FolioPageMountContractTest.php` (sorgente, senza app) fallisce se le due pagine perdono
`name()`/`@volt` canonici, se compaiono `container0.list`/`container0.detail`, `CmsPage` o `resolveHomeTitle`, o se il
dettaglio smette di usare `ResolvePageAction`.
