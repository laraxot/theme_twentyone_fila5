# Theme TwentyOne

Tema frontend con asset separati via Vite.

## Workflow corretto

```bash
cd /var/www/_bases/base_predict_fila5/laravel/Themes/TwentyOne
npm install
npm run build
npm run copy
```

`npm run build` genera gli asset hashati e `public/manifest.json` dentro il tema.
`npm run copy` pubblica il contenuto di `public/` in `public_html/themes/TwentyOne/`, che e' il percorso realmente letto da Laravel quando le Blade usano `@vite(..., 'themes/TwentyOne')`.

## Perche' serve anche `copy`

Il tema non usa il manifest della root Laravel. Usa un manifest dedicato:

```text
/var/www/_bases/base_predict_fila5/public_html/themes/TwentyOne/manifest.json
```

Se il file manca, Laravel lancia `ViteManifestNotFoundException`.

## Troubleshooting

- Se fallisce `build`, controlla prima i path `@import` verso `vendor/filament/*` nel CSS del tema.
- Se fallisce `copy`, controlla che lo script crei la directory `public_html/themes/TwentyOne`.
- Dopo modifiche a `resources/css/*`, `resources/js/*` o `vite.config.js`, riesegui sempre `npm run build` e `npm run copy`.

## Docs correlate

- `docs/assets-build-workflow.md`
- `docs/vite_manifest_error.md`
