# Workflow Asset Build - Theme TwentyOne

## Sintomo

```text
Illuminate\Foundation\ViteManifestNotFoundException
Vite manifest not found at: /var/www/_bases/base_predict_fila5/public_html/themes/TwentyOne/manifest.json
```

## Causa reale

La view del tema usa `@vite(..., 'themes/TwentyOne')`, quindi Laravel cerca il manifest dentro `public_html/themes/TwentyOne/`.

Questo implica due passaggi distinti:

1. `npm run build`
   genera `laravel/Themes/TwentyOne/public/manifest.json`
2. `npm run copy`
   copia quel manifest nella directory pubblica letta da Laravel

Senza `copy`, la build esiste ma il frontend continua a fallire.

## Procedura standard

```bash
cd /var/www/_bases/base_predict_fila5/laravel/Themes/TwentyOne
npm install
npm run build
npm run copy
```

## Verifiche

```bash
ls -la /var/www/_bases/base_predict_fila5/public_html/themes/TwentyOne
cat /var/www/_bases/base_predict_fila5/public_html/themes/TwentyOne/manifest.json
```

Devono esistere almeno:

- `manifest.json`
- `assets/app-*.css`
- `assets/app-*.js`

## Regole

- I path CSS verso `vendor/filament/*` devono essere relativi alla posizione reale del file nel tema.
- Lo script `copy` deve creare la directory di destinazione.
- Un errore manifest del tema va risolto prima nella pipeline asset, non nel codice PHP.

## Regola JS animation stack (GSAP)

Nel tema TwentyOne, `gsap` e `ScrollTrigger` devono essere gestiti come dipendenze npm e import ES module.

Motivazione architetturale:

- evita dipendenza da file globali `.min.js` caricati in Blade;
- mantiene il bundle coerente con Vite e con il manifest versionato;
- riduce regressioni tra ambienti (dev/build/copy) e mantiene il comportamento deterministico.

Implementazione obbligatoria:

1. `npm install gsap`
2. modulo `resources/js/gsap-core.js` per bootstrap di `gsap`
3. modulo `resources/js/gsap-scroll-trigger.js` per registrare `ScrollTrigger`
4. import dei due moduli in `resources/js/app.js`
5. `npm run build && npm run copy`

Riferimenti:

- `../resources/js/app.js`
- `../resources/js/gsap-core.js`
- `../resources/js/gsap-scroll-trigger.js`
