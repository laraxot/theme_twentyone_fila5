---
title: "ADR — L'header di TwentyOne non ha markup proprio: rende i blocchi del JSON raggruppati per data.position"
type: decision
status: accepted
theme: TwentyOne
created: 2026-11-24
updated: 2026-11-26
decision-makers: [team front office]
related:
  - ../HEADERNAV_CMS_ARCHITECTURE.md
  - ../JSON_ARCHITECTURE.md
---

# ADR: header = orchestratore di blocchi CMS per posizione

## Contesto

- Logo, menu, ricerca, selettore lingua e area utente cambiano tra installazioni e lingue; un `header.blade.php` con il
  markup scritto a mano andava modificato per ogni variazione ([HEADERNAV_CMS_ARCHITECTURE](../HEADERNAV_CMS_ARCHITECTURE.md)).
- I blocchi del JSON della sezione `header` (per lingua) hanno ognuno `view` e `data`, con `data.position`
  `left` | `center` | `right`.
- Domanda: dove si decide cosa compare nell'header e dove?

## Driver della decisione

- Cambiare logo, menu o area utente senza un deploy di codice del tema: sono dati del CMS.
- Un'installazione non deve forkare la Blade dell'header per spostare un elemento.
- Un blocco con una sorgente dati non ancora disponibile non deve togliere la navigazione a tutto il sito.

## Alternative scartate

- **Header Blade statico con slot**: ogni installazione lo forka.
- **Hook Filament (`renderHook`) per l'area utente**: provato e lasciato commentato nella Blade; lega l'header a un enum
  di modulo.
- **Eccezione che rompe la pagina se un blocco fallisce**: un datasource opzionale mancante non deve togliere la
  navigazione a tutto il sito.

## Decisione

- `resources/views/components/sections/header.blade.php` fa solo `collect($blocks)->groupBy('data.position')` e rende i
  blocchi di ciascun gruppo nelle tre celle della griglia (`left`, `center` visibile da `md`, `right`).
- Ogni blocco e' renderizzato con `view($block->view, $block->data)` dentro `try/catch`: un blocco la cui sorgente dati
  non e' disponibile si salta, l'header resta in piedi.
- Aggiungere o spostare un elemento = modificare il JSON, non la Blade.

## Conseguenze

- Pro: header configurabile per lingua e installazione senza deploy di codice del tema.
- Contro: il `catch` silenzioso nasconde anche errori veri di un blocco (nessun log): un blocco rotto sparisce senza traccia.
- Contro: `$pos->get('left')` senza gruppo da' `null` al `@foreach` se il JSON non ha blocchi in quella posizione.

## Stato attuale

Il file corrisponde all'ADR e ne conferma i due «contro» (`resources/views/components/sections/header.blade.php`, 44 righe):

- Il raggruppamento e' alla riga 3 (`collect($blocks)->groupBy('data.position')`); il rendering dei blocchi e' dentro
  `try { echo view($block->view, $block->data)->render(); } catch (\Throwable $e) { }` con il solo commento «Skip blocks
  whose optional datasource is not available yet» (righe 11-15, 22-26, 34-38): nessun `report()` e nessun log.
- `$pos->get('left')`, `get('center')` e `get('right')` non hanno valore di ripiego (righe 9, 20, 32). Un `foreach` su `null` e'
  un warning di PHP; in un'app Laravel i warning diventano `ErrorException`, quindi un JSON senza blocchi in una posizione
  rischia di rompere la pagina intera, non solo la cella. Non l'ho verificato eseguendo la vista.
- Il tema non e' privo di markup: ci sono `<header class="sticky top-0 z-50 bg-white">`, `<nav>`, `<ul>` con la griglia a tre
  celle e le classi Tailwind (righe 1, 6-8, 19, 30). L'ADR vieta solo logo, menu e ricerca scritti a mano, ed e' rispettato.
- La riga 31 contiene `renderHook(\Modules\Predict\Enums\Front\TopBarEnum::USER_MENU_BEFORE->value)` commentata:
  `Modules/Predict` non esiste in `laravel/Modules`.
- Non ho controllato i blocchi referenziati dal JSON dell'header ne' quale JSON TwentyOne fornisca.

## Conferma

Nessuna conferma automatica oggi: `Themes/TwentyOne/tests/Unit/FolioPageMountContractTest.php` e' l'unico test del tema e non
tocca l'header. Controllo di revisione, ripetibile dalla radice `laravel/`:
`rg -n "logo|<a |<img|search" Themes/TwentyOne/resources/views/components/sections/header.blade.php` non deve trovare markup di logo,
menu o ricerca (oggi non trova niente); il file deve contenere solo `groupBy('data.position')` e il rendering dei blocchi.

Proposta: un test sorgente in `Themes/TwentyOne/tests/Unit` che legga il file e verifichi `groupBy('data.position')`, l'assenza di
`<img`/`<a ` e la presenza di un valore di ripiego (`->get('left', collect())`), una volta deciso di correggere il `null`.
