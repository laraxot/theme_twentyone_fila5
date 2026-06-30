# Ponytail audit — TwentyOne

**Run:** 2026-06-30 · Tema produzione Predict (bridge-only).

Documento canonico: [ponytail-audit-over-engineering.md](../../ponytail-audit-over-engineering.md)

## Finding principale

`delete`→`.bak` `Main_files/` (~40k righe dump template) — non nel build Vite.

## Non tagliare

- Folio `container0/slug0`
- widget view Filament che puntano ai moduli

Hub: [ponytail-audit-themes.md](../../../../../../docs/project/ponytail-audit-themes.md)
