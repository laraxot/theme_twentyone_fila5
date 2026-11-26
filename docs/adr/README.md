---
title: "ADR del tema TwentyOne"
type: index
tags: [adr, decisioni, twentyone]
created: 2026-11-24
updated: 2026-11-26
---

# ADR del tema TwentyOne

TwentyOne e' un tema pubblico "agnostico" guidato dai JSON del CMS: le sue decisioni fissano i nomi delle pagine Folio
generiche e il fatto che le sezioni (l'header per primo) siano solo orchestratori di blocchi.

**Quando leggerli:** prima di creare una pagina Folio per un tipo di contenuto, rinominare slug/rotte `container0.*`, o
scrivere markup fisso in una sezione. Formato substantive (Contesto, Driver, Alternative, Decisione, Conseguenze, Conferma): [regola del canon](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).

## Decisioni

- [Pagine container0 agnostiche](agnostic-container0-pages.md) — `container0.index` / `container0.view`, payload neutro, tema template CMS-driven (**substantive**).
- [Header come blocchi per posizione](header-blocks-grouped-by-position.md) — l'header rende i blocchi JSON raggruppati per `data.position`, senza markup proprio.
