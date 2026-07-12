---
title: "Laravel 12 lang path rule — TwentyOne"
type: concept
tags: [twentyone, i18n, laravel12, lang]
created: 2026-04-21
updated: 2026-07-12
qmd: "TwentyOne theme lang path Laravel 12 not resources/lang"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/372"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/373"
related:
  - ../../../../../../docs/wiki/concepts/laravel12-lang-root-rule.md
---

# Laravel 12 lang path rule

## Sintesi

Per il tema `TwentyOne`, le traduzioni vivono in `lang/` e non in `resources/lang/`.

## Regola tema

- tema: `laravel/Themes/TwentyOne/lang/{locale}/...`
- host app: `laravel/lang/{locale}/...`
- non usare come standard: `resources/lang/...`

## Backlink

- [Regola globale Laravel 12 lang root](../../../../../docs/wiki/concepts/laravel12-lang-root-rule.md)
