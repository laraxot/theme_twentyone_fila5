# Route Names — Filosofia e Convenzioni

## Scopo

Nomi di route semantici e coerenti per le pagine container generiche del tema.

## Convenzione

| Pagina | Route Name | File | URL esempio |
|--------|------------|------|-------------|
| Lista container | `container0.list` | `[container0]/index.blade.php` | `/it/predicts` |
| Dettaglio item | `container0.view` | `[container0]/[slug0]/index.blade.php` | `/it/predicts/f1-champion-2026` |

## Regola anti-pattern

**MAI** creare `pages/it/predicts/[slug].blade.php`. Il routing usa il catch-all generico
`[container0]/[slug0]/index.blade.php` per tutti i container.

## Motivazione

- **list** = pagina elenco (lista mercati, articoli, eventi)
- **view** = pagina dettaglio (singolo mercato, articolo, evento)

Evita ambiguità: `container0.view` non deve indicare la lista.

## Uso nei componenti

```blade
{{-- Link alla lista --}}
<a href="{{ route('container0.list', ['container0' => 'predicts']) }}">Mercati</a>

{{-- Link al dettaglio --}}
<a href="{{ route('container0.view', ['container0' => 'predicts', 'slug0' => $slug]) }}">Dettaglio</a>
```

## Route legacy da non usare

- `predicts.list`
- `predicts.detail`
- `predict.view`
- `predicts.show`

Nel front office pubblico del tema tutto deve convergere su `container0.list` e `container0.view`.
