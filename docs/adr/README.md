---
title: "ADR del tema TwentyOne"
type: index
tags: [adr, decisioni, twentyone]
created: 2026-11-24
updated: 2026-11-26
---

# ADR del tema TwentyOne

TwentyOne e' un tema pubblico "agnostico" guidato dai JSON del CMS, ma non e' il tema attivo (`pub_theme` e' `Sixteen`): le sue
decisioni fissano i nomi delle pagine Folio generiche e il fatto che le sezioni (l'header per primo) siano solo
orchestratori di blocchi.

**Quando leggerli:** prima di creare una pagina Folio per un tipo di contenuto, rinominare slug/rotte `container0.*`, o
scrivere markup fisso in una sezione. Regola del canon:
[action-behavioral-contract](../../../../Modules/Xot/docs/rules/action-behavioral-contract.md).

## Formato

Un file per decisione, nome `NNNN-argomento.md` (numero progressivo a quattro cifre, richiesto da
`Modules/Xot/tests/Unit/Docs/AdrFilenamesAreNumberedTest.php`; la data sta nel frontmatter, mai nel nome). Il modello e'
`0000-template.md`. Frontmatter: `title`, `type: decision`, `status` (`accepted` | `superseded` | `deprecated`, con
`superseded_by` se sostituito), `created`, `updated`, `theme`, `decision-makers`. Sei sezioni `##`, in quest'ordine:

```markdown
## Contesto                 fatti e vincoli, con file e riga
## Driver della decisione   le forze che pesano sulla scelta
## Alternative scartate     ogni alternativa seria, col motivo
## Decisione                cosa si fa e dove sta nel codice
## Conseguenze              pro, contro, debito
## Conferma                 un test esistente, un comando da `laravel/` o una regola di revisione
```

Se il codice contraddice l'ADR si aggiunge `## Stato attuale` con le prove (file e riga). Se la **Conferma** non e'
automatica si scrive «Nessuna conferma automatica oggi; proposta: ...»: non si cita mai un test che non esiste.

## Decisioni

- [Pagine container0 agnostiche](0001-agnostic-container0-pages.md) — `container0.index` / `container0.view`, payload neutro, tema template CMS-driven. Il codice lo contraddice in parte (`Stato attuale`).
- [Header come blocchi per posizione](0002-header-blocks-grouped-by-position.md) — l'header rende i blocchi JSON raggruppati per `data.position`, senza markup di logo, menu o ricerca. Il codice lo rispetta.

## Stato di copertura

Misurato il 2026-11-26.

| Voce | Esito |
|:---|:---|
| ADR | 2 (all'inizio `0002` non aveva `Driver` e la sezione finale si chiamava `Verifica`) |
| Con le sei sezioni nel formato sopra | 2 su 2 |
| Con `## Stato attuale` | 2 su 2 |
| Con una Conferma automatica | 1 su 2, parziale: `0001` cita `FolioPageMountContractTest`, che copre due delle tre promesse; `0002` non ha test |

Contraddizioni trovate in `0001` (non corrette: sono scelte di prodotto):

- 34 pagine Folio oltre le due dei contenitori (`articles/`, `blog/`, `categories/`, `dashboard/`, `profile/`, ...).
- Il payload di `[slug0]/index.blade.php` ha `item` e `predictId`, non `record`.
- 26 file del tema nominano `Modules\Predict`, assente da `laravel/Modules`.

## Backlog

- Decisione umana: tenere o rimuovere le 34 pagine Folio legacy e `pages_old/`; senza questa decisione un test come quello di
  Sixteen sulle cartelle ammesse non si puo' scrivere.
- Test sorgente per l'header: `groupBy('data.position')`, niente `<img`/`<a `, valore di ripiego su `get('left')`.
- Decidere se `Modules\Predict` e' una dipendenza dichiarata del tema (`composer.json`) o va tolta dai blocchi.
