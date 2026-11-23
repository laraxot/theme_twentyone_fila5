---
title: "ADR — TwentyOne resta un tema alternativo isolato"
type: decision
status: accepted
theme: TwentyOne
created: 2026-06-05
updated: 2026-11-23
issues: []
---

# TwentyOne resta un tema alternativo isolato

## Contesto

TwentyOne contiene superfici alternative ma non è il tema runtime FixCity corrente.

## Decisione

Il tema resta isolato dalla configurazione attiva finché non sono verificate compatibilità con CMS, tenant, routing e
Design Comuni. Il suo contratto documentabile è limitato a presentazione, shell Folio e build Vite; non possiede il
dominio FixCity.

## Driver della decisione

- Evitare regressioni nel tema front office attivo.

## Alternative scartate

- Usarlo come fallback implicito di Sixteen.
- Condividere pagine e policy tramite copia manuale.
- Documentare come contratti del tema le Action di `Modules\Predict` o altri moduli non presenti.

## Conseguenze

Le sperimentazioni non alterano il front office attivo. `npm run build` produce gli asset in `public/`; il collegamento
del webroot deve restare una responsabilità del deploy, non una copia manuale documentata come requisito. L'attivazione
futura richiederà ADR di migrazione, test di parità e verifica delle dipendenze realmente disponibili.

## Conferma

Verificare configurazione runtime, compatibilità CMS e test di parità prima dell'attivazione.
