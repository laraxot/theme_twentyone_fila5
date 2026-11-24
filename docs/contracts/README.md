---
title: "Contratti del tema TwentyOne"
type: index
tags: [contracts, twentyone]
created: 2026-11-24
updated: 2026-11-24
---

# Contratti del tema TwentyOne

TwentyOne ha due Action, entrambe **di sola lettura** (preparano i dati di un blocco, non scrivono nulla, non chiamano
servizi esterni): per la regola del canon non servono contratti, e la cartella resta vuota.

| Action | Cosa fa | Perche' niente contratto |
|---|---|---|
| `app/Actions/Hero/ResolveCinematicHeroDataAction.php` | testi, CTA, statistiche e card del blocco `blocks/hero/cinematic` | legge `Modules\Predict` (conteggi, card), nessuna scrittura |
| `app/Actions/Markets/ResolveFeaturedMarketsGridDataAction.php` | etichette e card del blocco `blocks/markets/featured` | delega a `GetHomepageMarketCardsAction` di `Modules\Predict` |

Da sapere prima di imitarle:

- Dipendono da `Modules\Predict`, che non e' installato in ogni progetto che usa il tema: dove manca, i due blocchi non
  si rendono (il tema resta usabile solo se il JSON non li nomina).
- `ResolveFeaturedMarketsGridDataAction::execute()` chiama `$this__(...)` (11 occorrenze) invece di `$this->tx(...)`:
  e' una variabile indefinita, l'Action fallisce a runtime. Difetto da correggere, non uno stile da copiare.

**Dove stanno i contratti applicativi:** nei moduli (`Modules/Cms/docs/contracts/` per la risoluzione delle pagine, il
modulo di dominio per mercati e quote). Se il tema acquisisce un'Action che scrive dati o chiama l'esterno, il contratto va
qui nel formato del [canon](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).

## Contratti

Nessuno (le Action del tema sono di sola lettura).
