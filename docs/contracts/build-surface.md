---
title: "Contratto — build asset TwentyOne"
type: build-contract
theme: TwentyOne
created: 2026-11-23
updated: 2026-11-23
issues: []
---

# Build asset TwentyOne

## Input

- Sorgenti Vite del tema e `package.json`.
- `npm run build`, che esegue `vite build`.

## Output

Asset compilati nella directory `public/` del tema secondo `vite.config.js`.

## Invarianti

- TwentyOne è un tema alternativo isolato, non il tema pubblico FixCity corrente.
- Il webroot deve esporre `public/` tramite il collegamento previsto dal deploy.
- Il dominio applicativo e le policy restano fuori dal tema.

## Effetti collaterali

Vite aggiorna gli asset compilati e il manifest nella directory `public/`.

## Errori

Un fallimento di `vite build` rende non verificato l'output; la presenza di asset precedenti non è prova di build corrente.

## Non fa

- Non considera `npm run copy` una prova di deploy o un requisito del tema: lo script legacy esiste nel manifest, ma la
  policy del workspace richiede il symlink del webroot.
- Non attiva TwentyOne come fallback implicito di Sixteen.
- Non documenta contratti di dominio inesistenti nel tema.
