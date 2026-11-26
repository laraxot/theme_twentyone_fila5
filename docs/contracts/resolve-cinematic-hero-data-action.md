---
title: "Contratto — ResolveCinematicHeroDataAction"
type: contract
action: "Themes\\TwentyOne\\Actions\\Hero\\ResolveCinematicHeroDataAction"
module: TwentyOne
status: accepted
updated: 2026-11-26
related:
  - ../../resources/views/components/blocks/hero/cinematic.blade.php
---

# ResolveCinematicHeroDataAction

Prepara i dati del blocco `blocks/hero/cinematic`, che la chiama da `resources/views/components/blocks/hero/cinematic.blade.php:9`.
Sola lettura, ma **non** autonoma: dipende da `Modules\Predict`, che non esiste in `laravel/Modules`. Il contratto descrive
il codice cosi' com'e', non una versione ideale.

## Input

- `execute(?string $heroTitle = null, ?string $heroSubtitle = null, ?array $ctaPrimary = null, ?array $ctaSecondary = null)`:
  titolo, sottotitolo e CTA (`['text' => ..., 'url' => ...]`) arrivano dal JSON del blocco.
- Legge: `Modules\Predict\Actions\Homepage\GetHomepageHeroDataAction` (conteggi), `GetHomepageMarketCardsAction::execute(3,
  'featured')` (card), il modello `Modules\Predict\Models\Predict` (query di ripiego), lo schema (`hasColumn('sum_credit_yes')`),
  le traduzioni `predict::home.hero.*` e `app('laravellocalization')`.

## Output

Un array con le chiavi `eyebrow`, `title`, `subtitle`, `primaryCta`, `secondaryCta` (`text`, `url`), `stats` (3 voci
`value`, `label`, `icon`), `highlights` (3 stringhe), `spotlightCards` (zero o piu' card di mercato; forma nel docblock
dell'Action).

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| TWENTYONE-HERO-INV-1 | Solo presentazione: l'Action non scrive su database, sessione o file e non chiama servizi esterni; legge soltanto. Se viene violata, il rendering di una homepage cambia dati di dominio. | — (non dimostrato) |
| TWENTYONE-HERO-INV-2 | Un errore nel calcolo delle card in primo piano o nella query di ripiego non fa fallire l'Action: viene segnalato con `report()` e `spotlightCards` resta `[]` (`ResolveCinematicHeroDataAction.php`, blocchi `try`/`catch (Throwable)`). Non vale per `GetHomepageHeroDataAction`, chiamata fuori dai `try`. | — (non dimostrato) |

Nessun test del tema porta i group `TWENTYONE-HERO-INV-1` o `-2` (`grep` in `Themes/TwentyOne/tests` e `Modules/*/tests`: nessun
risultato): `tests/Unit/FolioPageMountContractTest.php` e' l'unico test del tema e non riguarda l'Action. Una versione precedente
di questo file dichiarava un `->group(...)` che non esisteva: corretto.

## Effetti collaterali

- Letture: query su `Predict` (`visible()`, `has('ratings', '>=', 4)`, eventualmente `show_on_homepage`), un controllo di
  schema (`Schema::hasColumn`) che interroga il database, e le due Action di `Modules\Predict`.
- Scritture: nessuna sul database o sulla sessione; in caso di errore `report($e)` scrive nel log dell'applicazione.
- Nessuna chiamata HTTP.

## Errori

- Le eccezioni delle query di ripiego e di `buildSpotlightCards()` sono catturate (INV-2) e segnalate.
- Se `Modules\Predict` manca, `app(GetHomepageHeroDataAction::class)` non si risolve e l'errore **propaga** (la chiamata e' fuori dai
  `try`): il blocco hero non si rende.
- Le traduzioni mancanti non sono un errore: `translateText()` ricade sul testo italiano scritto nell'Action.

## Non fa

- Non e' owner di contenuti Fixcity ne' di Predict: contenuti, policy e conteggi restano nei moduli.
- Non valida `$ctaPrimary`/`$ctaSecondary`: legge solo `text` e `url`, con `(string)`.
- Non filtra per lingua i dati dei mercati: usa solo `app()->getLocale()` per costruire gli URL.

## Limiti noti

- Limite noto: i testi di ripiego sono stringhe italiane scritte nell'Action (`translateText('...', 'Prevedi il Futuro')` e
  simili), contro la regola «mai stringhe in una lingua nel codice».
- Limite noto: `$heroTitle ? $heroTitle : ...` tratta `'0'` e `''` come assenti.
- Limite noto: nessun test; le due invarianti sono verificabili solo leggendo il codice.
