---
title: "ADR — L'header di TwentyOne non ha markup proprio: rende i blocchi del JSON raggruppati per data.position"
type: decision
status: accepted
theme: TwentyOne
created: 2026-11-24
updated: 2026-11-24
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

## Decisione

- `resources/views/components/sections/header.blade.php` fa solo `collect($blocks)->groupBy('data.position')` e rende i
  blocchi di ciascun gruppo nelle tre celle della griglia (`left`, `center` visibile da `md`, `right`).
- Ogni blocco e' renderizzato con `view($block->view, $block->data)` dentro `try/catch`: un blocco la cui sorgente dati
  non e' disponibile si salta, l'header resta in piedi.
- Aggiungere o spostare un elemento = modificare il JSON, non la Blade.

## Alternative scartate

- **Header Blade statico con slot**: ogni installazione lo forka.
- **Hook Filament (`renderHook`) per l'area utente**: provato e lasciato commentato nella Blade; lega l'header a un enum
  di modulo.
- **Eccezione che rompe la pagina se un blocco fallisce**: un datasource opzionale mancante non deve togliere la
  navigazione a tutto il sito.

## Conseguenze

- Pro: header configurabile per lingua e installazione senza deploy di codice del tema.
- Contro: il `catch` silenzioso nasconde anche errori veri di un blocco (nessun log): un blocco rotto sparisce senza traccia.
- Contro: `$pos->get('left')` senza gruppo da' `null` al `@foreach` se il JSON non ha blocchi in quella posizione.

## Verifica

Solo revisione: `sections/header.blade.php` non deve contenere markup di logo/menu/ricerca, solo il raggruppamento per
`data.position` e il rendering dei blocchi; nessun test automatico lo controlla ancora.
