---
title: "Boundary Composer dei temi"
type: raw-note
theme: TwentyOne
created: 2026-06-30
tags: [composer, theme, boundary, nwidart]
source:
  - /var/www/_bases/base_predict_fila5/laravel/composer.json
  - /var/www/_bases/base_predict_fila5/laravel/Themes/TwentyOne/composer.json
---

# Boundary Composer dei temi

Il confronto con FixCity conferma che il root Composer deve fondarsi su `nwidart/laravel-modules` e includere solo `Modules/*/composer.json`.

TwentyOne puo' mantenere un proprio `composer.json` per portabilita' del tema, test locale e package di tema. Quel file non deve pero' essere incluso nel merge-plugin root in questo progetto, perche' il tema resta bridge-only: layout, composizione e shell, non ownership delle dipendenze applicative.
