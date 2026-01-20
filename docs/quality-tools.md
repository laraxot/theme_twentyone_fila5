# Quality Tools Usage (Theme TwentyOne)

Theme-specific guidance for PHPMD, PHP-CS-Fixer, Laravel Pint, Psalm, PHPQA, actionlint, markdownlint, gitleaks. Canonical reference: `Modules/Xot/docs/QUALITY_TOOLS.md`.

## Scope
- Analyze only `Themes/TwentyOne` and related theme PHP code.
- Prefer report/dry-run first; visually verify pages after any change.

## Safe Commands (Report/Dry-Run)
```bash
# PHPMD (only PHP files)
vendor/bin/phpmd Themes/TwentyOne text cleancode,codesize,design,naming,unusedcode --ignore-violations-on-exit --suffixes php

# Pint (test only)
vendor/bin/pint --test --preset laravel --path Themes/TwentyOne

# PHP-CS-Fixer (dry-run)
vendor/bin/php-cs-fixer fix Themes/TwentyOne --dry-run --diff --using-cache=yes

# Psalm (informational)
vendor/bin/psalm --no-cache --no-diff --show-info=true --paths=Themes/TwentyOne

# PHPQA (reports)
vendor/bin/phpqa --analyzedDirs Themes/TwentyOne --report --output build/phpqa-twentyone --tools phpmd,phpcs,phpcpd --execution no-ansi

# Markdownlint (docs)
npx --yes markdownlint-cli "Themes/TwentyOne/docs/**/*.md"

# actionlint (GitHub Actions)
docker run --rm -v "$PWD":/repo -w /repo ghcr.io/rhysd/actionlint:latest -color

# gitleaks (secrets)
docker run --rm -v "$PWD":/path zricethezav/gitleaks:latest detect --no-git --source=/path --report-format=json --report-path=/path/build/gitleaks.json || true
```

## Apply Changes (After Review)
```bash
vendor/bin/pint --path Themes/TwentyOne
# or
vendor/bin/php-cs-fixer fix Themes/TwentyOne --allow-risky=no
```

## Notes
- Maintain parity with `Themes/Sixteen` and `Modules/UI` components.
- After changes, rebuild assets and visually test key pages.
- Track suppressions with rationale and review dates.
