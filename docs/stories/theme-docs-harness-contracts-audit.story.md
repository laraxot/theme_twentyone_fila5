---
type: story
theme: TwentyOne
status: completed
created: 2026-11-23
updated: 2026-11-23
issues: []
---

# Audit harness dei documenti TwentyOne

## Obiettivo

Separare i contratti verificabili di presentation/build dalle responsabilità di dominio e correggere la documentazione
di pubblicazione non coerente con il symlink del webroot.

## Risultato

ADR e contratto build descrivono TwentyOne come tema alternativo isolato. `npm run build` produce `public/`; lo script
legacy `copy` non è documentato come requisito di deploy.

## Prova

`package.json`, `vite.config.js`, test Folio locali e configurazione `pub_theme` sostengono il perimetro documentato.
