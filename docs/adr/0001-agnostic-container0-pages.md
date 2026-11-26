---
title: "ADR — Le pagine Folio di TwentyOne sono due contenitori agnostici: container0.index e container0.view"
type: decision
status: accepted
theme: TwentyOne
created: 2026-11-24
updated: 2026-11-26
decision-makers: [team front office]
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
- TwentyOne non e' il tema pubblico: `config/local/fixcity/xra.php:10` imposta `'pub_theme' => 'Sixteen'`. Ha `theme.json`
  con `"active": true`, ma `composer.json` dichiara `"providers": []` e non esiste `app/Providers`.
- Domanda: come si chiamano rotte, slug CMS e payload delle due pagine generiche?

## Driver della decisione

- Le pagine container0 restano agnostiche rispetto al dominio: contenuti e policy stanno nei moduli owner, non nel tema.
- Un tipo di contenuto nuovo si deve poter aggiungere con dati (JSON CMS), non con una pagina Folio.
- Un nome Folio/Volt solo per ruolo (`index`, `view`), perche' JSON e link devono sapere quale aspettarsi.

## Alternative scartate

- **Una pagina Folio per tipo** (`pages/predicts/[slug].blade.php`): duplica la pagina per ogni modulo e lega il tema ai
  moduli installati.
- **Slug liberi per pagina** (`.list`, `.detail`, `.show`): i JSON e i link non sanno quale aspettarsi.
- **Variabili col nome del modulo** (`$predict`): il container smette di essere riusabile per un altro tipo.

## Decisione

- Elenco: `name('container0.index')`, `@volt('container0.index')`, `$this->pageSlug = $container0.'.index'`.
- Dettaglio: `name('container0.view')`, `@volt('container0.view')`, risoluzione con `Modules\Cms\Actions\ResolvePageAction`
  e middleware `PageSlugMiddleware`; slug CMS `<container0>.view` (es. `articles.view`).
- Il payload del container e' neutro (`item`, `record`); i blocchi del JSON leggono da li'. Gli alias col nome del modulo
  sono solo compatibilita' in uscita.
- `mount()` lineare nella classe Volt, nessuna query di dominio nella pagina.

## Conseguenze

- Pro: un tipo nuovo si aggiunge con due JSON (`<tipo>.index.json`, `<tipo>.view.json`), senza toccare il tema.
- Contro: i blocchi del dettaglio devono saper leggere `item`/`record` generici.
- Debito: le Action `app/Actions/Hero` e `app/Actions/Markets` e diversi blocchi nominano ancora `Modules\Predict`
  (vedi [contratti](../contracts/README.md)).

## Stato attuale

Il codice di TwentyOne rispetta l'ADR solo per le due pagine nominate; attorno ad esse ci sono altre pagine che lo
contraddicono. Misurato dalla radice `laravel/`:

- **Le due pagine sono corrette nella forma**: `container0.index` e `container0.view` con `@volt` coerente, `mount()` e
  `PageSlugMiddleware`; l'indice non ha logica di dominio (`pages/[container0]/index.blade.php`).
- **Altre 34 pagine Folio** accanto alle due (`find resources/views/pages -type f ! -name .gitkeep` ne trova 36 in tutto):
  `articles/`, `blog/`, `categories/`, `dashboard/`, `genesis/`, `it/markets/`, `profile/edit.blade.php`, `[slug].blade.php`,
  `cart`, `search`, `todos`, `prova`, `prova1`, `hello`, `test_volt` e altre. Contraddicono «due contenitori»: per esempio
  `pages/articles/[slug].blade.php` interroga `Modules\Blog\Models\Article` nella pagina (riga 16) e include
  `pub_theme::article.show.content`. Folio da' la precedenza a una cartella con il nome esatto sul jolly `[container0]` (lo
  documenta il commento di `Themes/Sixteen/tests/Unit/NoSemanticFolioPageDirectoriesTest.php:39-41`, misurato da altri su
  Folio 1.2.0): per `/articles/...`, `/blog/...`, `/categories/...` il contenitore agnostico non viene raggiunto.
- **Il payload non e' quello dell'ADR**: `[slug0]/index.blade.php` costruisce `container0`, `slug0`, `slug`, `item` e
  `predictId` (righe 36-42), con `predictId = $item->id` quando `$item` e' un oggetto (riga 34). Non esiste `record`, e `predictId` e'
  una variabile col nome del modulo, cioe' quello che l'ADR scarta.
- **Il tema dipende da un modulo assente**: `Modules/Predict` non esiste in `laravel/Modules`, ma 26 file del tema lo
  nominano (`rg -l "Modules.Predict|Predict::" app resources routes`), tra cui le due Action e `components/sections/header.blade.php`.
- Il tema non registra provider (`"providers": []`), quindi le sue pagine non sono raggiungibili finche' non e' `pub_theme`.

## Conferma

Conferma automatica parziale: `Themes/TwentyOne/tests/Unit/FolioPageMountContractTest.php` (sorgente, senza app), due test:

- «container0 pages usano mount lineare e name filament way»: `pages/[container0]/index.blade.php` ha
  `name('container0.index')`, `@volt('container0.index')`, `pageSlug = $container0.'.index'` e non contiene
  `container0.list`, `CmsPage`, `resolveHomeTitle`;
- «container0 slug0 usa container0.view e ResolvePageAction»: `[slug0]/index.blade.php` ha `name('container0.view')`,
  `@volt('container0.view')`, `ResolvePageAction`, e non contiene `container0.detail` ne' `container0.list`.

Comando, dalla radice `laravel/`: `vendor/bin/pest Themes/TwentyOne/tests/Unit/FolioPageMountContractTest.php` (non eseguito in
questa passata). Il test **non** controlla il payload neutro (`record`), l'assenza di query di dominio, ne' l'assenza delle
altre 34 pagine Folio. Nessuna conferma automatica oggi per queste tre promesse; proposta: un test sorgente che fallisca se
`resources/views/pages` contiene file oltre `[container0]`, `auth`, `index.blade.php` e `.gitkeep`, sul modello di
`Themes/Sixteen/tests/Unit/NoSemanticFolioPageDirectoriesTest.php`, dopo che qualcuno ha deciso cosa fare delle pagine esistenti.
