---
status: accepted
theme: TwentyOne
---

# TwentyOne resta un tema alternativo isolato

## Contesto

TwentyOne contiene superfici alternative ma non è il tema runtime FixCity corrente.

## Decisione

Il tema resta isolato dalla configurazione attiva finché non sono verificate compatibilità con CMS, tenant, routing e Design Comuni.

## Driver della decisione

- Evitare regressioni nel tema front office attivo.

## Alternative scartate

- Usarlo come fallback implicito di Sixteen.
- Condividere pagine e policy tramite copia manuale.

## Conseguenze

Le sperimentazioni non alterano il front office attivo; l'attivazione futura richiederà ADR di migrazione e test di parità.

## Conferma

Verificare configurazione runtime, compatibilità CMS e test di parità prima dell'attivazione.
