# TwentyOne Theme LLM Wiki#

Indice operativo del wiki TwentyOne.

## Struttura canonica (sacra)

- [concepts/](./concepts/): Pattern architetturali e metodologie tema.
- [entities/](./entities/): Componenti e layout chiave.
- [sources/](./sources/): Dati di ricerca e link esterni.
- [comparisons/](./comparisons/): Implementazioni alternative.
- [decisions/](./decisions/): Decisioni design tema.
- [troubleshooting/](./troubleshooting/): Problemi noti e soluzioni.
- [_archive/](./_archive/): Documentazione legacy.
- [_templates/](./_templates/): Template standard.

## Regole collegate

- [forbidden-folders-rule](../../../../docs/wiki/concepts/forbidden-folders.md): Vincoli strutturali strict.
- [llm-wiki-standard](../../../../docs/project/karpathy-llm-wiki-adoption.md): Mapping repository e ciclo di vita conoscenza.
- [laravel12-lang-path-rule](./concepts/laravel12-lang-path-rule.md): Path corrette Laravel 12.
- [theme-css-only-parity-rule](../../../../laravel/Themes/Sixteen/docs/wiki/concepts/theme-css-only-parity-rule.md): CSS solo in tema, non inline.
- [phpmd-standalone-phar-rule](../../../../docs/wiki/concepts/phpmd-standalone-phar-rule.md): quality gates del tema con PHPMD standalone `.phar`, mai via Composer.

## Scopo TwentyOne Theme

Tema alternativo zen-agnostic con design kinetic, GSAP animations e integrazione CMS.

## Compiled Pages

| Pagina | Tipo | Argomento | Data |
|--------|------|-----------|------|
| [twentyone-theme](./overviews/twentyone-theme.md) | Overview | Zen agnostic, kinetic design | 2026-04-21 |
| [laravel12-lang-path-rule](./concepts/laravel12-lang-path-rule.md) | Concept | Path Laravel 12 | 2026-04-21 |

## Best Practices

- Usare componenti Blade riutilizzabili (vedi [blade-component-extraction-governance](../../../../docs/wiki/concepts/blade-component-extraction-governance.md))
- Estendere XotBase classes per Folio pages (vedi [xotbase-check](../../../../docs/wiki/concepts/xotbase-check.md))
- Usare GSAP per animazioni kinetic (vedi [kinetic-web-design](../../../../docs/wiki/concepts/kinetic-web-design.md))

## Bad Practices

- NON creare Service classes - usare Actions (vedi [actions-over-services-governance](https://github.com/laraxot/base_fixcity_fila5/blob/main/.opencode/skills/actions-over-services-governance/SKILL.md))
- NON usare `dehydrated(false)` nei trait - blocca salvataggio (vedi Geo CoordinatePicker fix)
- NON hardcodare animazioni - usare config tema

## False Friends

- `dehydrated(false)` sembra mantenere il campo nei dati ma blocca il salvataggio (vedi [coordinate-picker-filament5-save-pattern](../../Geo/docs/wiki/concepts/coordinate-picker-filament5-save-pattern.md))
- `live()` in Filament non rende il campo sempre live - serve `$applyStateBindingModifiers()` (vedi [coordinate-picker-state-binding-rule](../../Geo/docs/wiki/concepts/coordinate-picker-state-binding-rule.md))

## Troubleshooting

| Pagina | Tipo | Argomento |
|--------|------|-----------|
| [twentyone-theme](./overviews/twentyone-theme.md) | Overview | Zen agnostic theme |

Aggiornato: 2026-04-28
