---
title: "Manuale FO + fix a11y/404 — front office TwentyOne"
type: story
status: done
tags: [front-office, manuale, accessibilità, routing, folio, cms]
created: 2026-08-27
related:
  - ../manuale-uso-front-office.md
  - ../../../Cms/docs/stories/cms-foot-component.story.md
---

# Story: Manuale d'uso FO + rifinitura audit

## Obiettivo
Completare il progetto FO producendo un manuale utente verificato sul comportamento reale e correggendo i difetti scoperti durante la stesura (regola utente: "facendo il manuale ti accorgi che qualcosa andava fatta meglio .. falla").

## Criteri di accettazione
- [x] Manuale `.md` in `Themes/TwentyOne/docs/` + PDF generato
- [x] Rotte documentate = rotte reali verificate via HTTP
- [x] Soft-404 corretti in HTTP 404 reali
- [x] Link footer morti rimossi
- [x] Marker conflitto git residui verificati = 0 attivi
- [x] PHPStan level 10 pulito sui file toccati

## Lavoro svolto
1. **Audit reso fixes**: controlli icona → `button` semantici con ARIA; `aria-label` social/logo/dropdown; heading footer h4→h3; touch target header/footer.
2. **Folio `[slug].blade.php`**: `abort(404)` spostato da top-level a `render()` — top-level abort esplodeva durante la route discovery di `FolioRoutes->has()` (500 su tutte le pagine).
3. **Soft-404**: `[container0]/index` e `[container0]/[slug0]/index` ora `abort(404)` quando la pagina CMS non esiste o l'item dinamico manca su `.view`. `/it/markets`, `/it/nonexistent-404`, `/it/predicts/create` → 404 reali.
4. **Link morto**: "Crea Mercato" (`/predicts/create`, rotta inesistente) rimosso da `footer.json` (config modulo + override local).
5. **Conflitti git**: `.cursor/rules/*.mdc` e doc Activity/Barthelemy già ripuliti; scan finale: solo esempi doc e backup, nessun marker attivo.
6. **Manuale**: `manuale-uso-front-office.md` + `manuale-uso-front-office.pdf`.

## Verifica
- `curl`: /it 200, /it/predicts 200, /it/articles 200, /it/pages/about 200, /it/blog 302; /it/markets, /it/nonexistent-404, /it/predicts/create → 404
- `phpstan analyse Themes/TwentyOne/resources/views/pages Modules/Cms/app/View/Components --level=10` → No errors
- grep `predicts/create` nella home → 0 occorrenze

## Debito residuo
- Dark mode dual non deciso; bundle CSS ~1.09MB; Sixteen Head/Foot non allineato; prompt `bashscripts/docs/prompts` da revisionare.
