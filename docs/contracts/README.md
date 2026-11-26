---
title: "Contratti del tema TwentyOne"
type: index
tags: [contracts, twentyone]
created: 2026-11-24
updated: 2026-11-26
---

# Contratti del tema TwentyOne

TwentyOne ha due Action in `app/Actions`, entrambe di sola lettura sul proprio dominio (non scrivono, non chiamano servizi
esterni) ma legate a `Modules\Predict`, che non esiste in `laravel/Modules`. Ne ha un contratto una sola; l'altra non e'
chiamata da nessuno e non funziona.

## Contratto di comportamento di un'Action

Un file per Action, nome in kebab-case della classe (`create-ticket-action.md`), frontmatter `type: contract`, `action: <FQCN>`,
`module`, `status`, `updated`, e queste sei sezioni nell'ordine: `## Input`, `## Output`, `## Invarianti`,
`## Effetti collaterali`, `## Errori`, `## Non fa`. Le invarianti sono una tabella `| ID | Regola | Group Pest |` con ID
`<SCOPE>-INV-<N>`; il Group e' l'ID usato in `->group('<ID>')` da un test che la dimostra, altrimenti
«— (non dimostrato)». Il docblock dell'Action contiene `@see docs/contracts/<file>.md` e `@contract docs/contracts/<file>.md`.
Regola: [canon](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).

## Contratti

- [ResolveCinematicHeroDataAction](resolve-cinematic-hero-data-action.md) — dati del blocco `hero/cinematic`; `TWENTYONE-HERO-INV-1..2`.

## Stato di copertura

Misurato il 2026-11-26.

| Voce | Esito |
|:---|:---|
| Action in `app/Actions` | 2 |
| Con contratto | 1 (`ResolveCinematicHeroDataAction`) |
| Invarianti | 2 |
| Con un group Pest | 0 su 2: il tema ha un solo test (`FolioPageMountContractTest`) e non riguarda le Action |
| Action che scrivono o chiamano l'esterno senza contratto | 0 |

Nessun test e' stato eseguito in questa passata.

## Action senza contratto, e perche'

| Action | Cosa fa | Perche' niente contratto |
|:---|:---|:---|
| `app/Actions/Markets/ResolveFeaturedMarketsGridDataAction.php` | etichette e card del blocco `blocks/markets/featured` | sola lettura (delega a `GetHomepageMarketCardsAction` di `Modules\Predict`) e **senza chiamanti** (nessun riferimento in `Themes`, `Modules`, `config`, `routes`, `app`); chiama `$this__(...)` |

## Difetto trovato (non corretto)

`app/Actions/Markets/ResolveFeaturedMarketsGridDataAction.php` chiama `$this__('predict::...')` alle righe 45, 46 e 48-56
(11 occorrenze) invece di `$this->tx(...)`: `$this__` e' una variabile indefinita, quindi `execute()` fallisce a runtime. Il
metodo privato `tx()` esiste ma non e' mai usato. Nessuno la chiama, quindi oggi non si manifesta.

## Backlog contract

- `ResolveFeaturedMarketsGridDataAction`: nessun contratto finche' non e' corretta e usata da un blocco; poi un contratto in
  sola lettura con le etichette `predict::home.featured_markets.*`.
- Decisione umana: `Modules\Predict` e' una dipendenza del tema (26 file la nominano) ma non e' installato; senza di esso i due
  blocchi non si rendono e la vista hero va in errore.

## Backlog test

- `TWENTYONE-HERO-INV-1`, `TWENTYONE-HERO-INV-2`: un test con `Modules\Predict` simulato (Mockery sulle due Action) che verifichi
  che le eccezioni delle card non propaghino e che nessuna scrittura avvenga; richiede un `TestCase` con l'app.

**Dove stanno i contratti applicativi:** nei moduli (`Modules/Cms/docs/contracts/` per la risoluzione delle pagine, il modulo
di dominio per mercati e quote). Se il tema acquisisce un'Action che scrive dati o chiama l'esterno, il contratto va qui.
