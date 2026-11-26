# archive/docs-legacy — Theme TwentyOne

Documenti `.md` rimossi da `docs/` per rispettare il tetto di **100 file markdown**
(issue #10). Nessun file è stato cancellato: tutto è conservato qui.

I link interni dei documenti mantenuti in `docs/` sono stati aggiornati e
puntano a questa cartella (`archive/docs-legacy/<sezione>/<file>`).

## Contenuto

| Cartella | Provenienza | Motivo |
|---|---|---|
| `root/` | `docs/*.md` (114 file) | analisi una tantum, fix una tantum, duplicati UPPERCASE/lowercase, sprint/passati, methodology di terze parti |
| `predict/` | `docs/predict/` (28 file) | analisi e summary di implementazione; restano README, best-practices, technical-specifications, multilingual-support, translation-keys, recommendations |
| `kalshi-analysis/` | `docs/kalshi-analysis/` (2 file) | duplicati maiuscoli di `detail-page-analysis.md` e `homepage-analysis.md` |
| `prompts/` | `docs/prompts/` (7 file) | prompt di lavoro uno-shot (`study.md`, `particles.md`, `fixes/*`) |
| `root-txt-files/` | `docs/root-txt-files/` (2 file) | appunti `untitled-note*` |
| `memories/` | `docs/memories/antigravity-auth-success.md` | memoria di un fix singolo |
| `roadmap/` | `docs/roadmap/2025-Q4-ROADMAP.md` | roadmap datata; resta `theme-roadmap.md` |

Inoltre sono stati eliminati 7 file `*.md.old` (ignorati da git, mai tracciati).

## Mantenuto in `docs/` (99 file)

- Radice: 47 file — indici, README, policy/regole, guide di architettura
  (homepage, headernav, json, footer, routing, blade), contratti, Filament 5,
  design system, roadmap e PRD.
- `adr/` (5), `contracts/` (5), `stories/` (3), `wiki/` (19), `phpstan/` (3),
  `raw/` (2), `i18n/`, `concepts/`, `memories/theme-asset-pipeline.md`,
  `llm-wiki/`, `roadmap/theme-roadmap.md`, `predict/` (6), `kalshi-analysis/` (4).

## Ripristino

```bash
mv archive/docs-legacy/root/<file>.md docs/<file>.md
mv archive/docs-legacy/predict/<file>.md docs/predict/<file>.md
```
