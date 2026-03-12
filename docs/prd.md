# Theme TwentyOne - Product Requirements Document (PRD)

> Documento vivente. Tema pubblico principale del prediction market.
> Stato stimato: 58% implementato, 42% da convergere.

## 1. Purpose & Vision

**TwentyOne** e' il tema frontend principale per il sito pubblico `predict.local`: homepage, listing, pagine mercato e superfici narrative del prodotto.

**Visione**: tema moderno e orientato al prediction market, con asset buildati correttamente, CMS integration pulita e UI onesta rispetto alle capacita' reali del backend.

## 2. Problem Statement

Senza TwentyOne:
- il prediction market non ha una superficie pubblica distintiva
- il Cms non riesce a comporre homepage, sezioni e blocchi del brand
- il progetto perde coerenza tra contenuti, listing e pagine mercato

## 3. Target Users

| User | Ruolo | Bisogni |
|------|-------|---------|
| **Visitore guest** | Consulta homepage e mercati | Chiarezza, velocita', accesso senza login |
| **Trader registrato** | Entra nel dettaglio mercato | Dati mercato leggibili e CTA corrette |
| **Editor/Admin** | Aggiorna contenuti e blocchi | Tema stabile e compatibile col Cms |

## 4. Scope

### In Scope
- Homepage pubblica e pagine CMS
- Componenti header/footer/sections/blocks
- Pagine public del modulo Predict
- Build asset via Vite con pubblicazione del manifest runtime

### Out of Scope
- Pannello admin Filament
- Componenti PA-oriented del tema Sixteen

## 5. Functional Requirements

### P0
- **FR-001**: La homepage guest deve rispondere senza login e senza errori runtime.
- **FR-002**: Il tema deve esporre i componenti richiesti dal Cms (`sections`, `blocks`, `header`, `footer`).
- **FR-003**: La pipeline asset deve garantire `npm install`, `npm run build`, `npm run copy`.
- **FR-004**: Le pagine public Predict devono evitare mock fuorvianti quando il backend non supporta ancora un dato.

### P1
- **FR-005**: Migliorare coerenza visiva fra listing, detail page e widget mercato.
- **FR-006**: Ridurre elementi legacy ancora vicini a pattern Filament 3/4 o fallback inconsistenti.

## 6. Non-Functional Requirements

- **NFR-001**: Nessun `ViteManifestNotFoundException` in runtime.
- **NFR-002**: Compatibilita' piena con Cms e Predict.
- **NFR-003**: Asset e manifest sempre allineati al path letto da Laravel.

## 7. Current State & Gaps

### Stato reale al 2026-03-12
- Build/copy documentati e funzionanti: **80%**
- Compatibilita' homepage Cms: **70%**
- Veridicita' UI di mercato: **35%**
- Coerenza completa header/footer/brand: **55%**

### Gap prioritari
- eliminare widget o blocchi che mostrano dati non ancora supportati dal backend
- chiudere residui di duplicazione visiva e componenti wrapper incompleti
- rafforzare test guest page e smoke test frontoffice

## 8. Success Metrics

| Metrica | Target |
|--------|--------|
| Homepage guest `200 OK` | 100% |
| Errori manifest tema | 0 |
| Surface di mercato con dati reali o stato esplicito | 100% |

## 9. References

- [README.md](README.md)
- [vite_manifest_error.md](vite_manifest_error.md)
- [PRD Indice Centrale](../../../project_docs/PRD_INDEX_2026_03_12.md)

## Testing & Coverage

- smoke test guest homepage
- test Pest su accesso pubblico
- verifica manuale/screenshot dei componenti critici del frontoffice
