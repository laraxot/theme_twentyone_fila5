---
title: "Contratto — ResolveCinematicHeroDataAction"
type: contract
action: "Themes\\TwentyOne\\Actions\\Hero\\ResolveCinematicHeroDataAction"
module: TwentyOne
status: accepted
updated: 2026-11-26
---

# ResolveCinematicHeroDataAction

Classe: `Themes\\TwentyOne\\Actions\\Hero\\ResolveCinematicHeroDataAction`

## Input

- Dati CMS/config del blocco hero (vedi firma `execute`).

## Output

- Array/DTO per la vista hero cinematografica del tema.

## Invarianti

| ID | Regola | Verifica |
|---|---|---|
| TWENTYONE-HERO-INV-1 | Solo presentazione: non muta ticket, policy o DB di dominio. | `->group('TWENTYONE-HERO-INV-1')` |
| TWENTYONE-HERO-INV-2 | Null-safe su relazioni/campi assenti (niente TypeError in front). | `->group('TWENTYONE-HERO-INV-2')` |

## Effetti collaterali

- Nessuno (read/resolve).

## Errori

- Fallback a default tema se dati assenti.

## Non fa

- Non è owner di contenuti Fixcity (restano nei moduli).
