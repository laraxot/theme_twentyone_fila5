<?php

declare(strict_types=1);

namespace Themes\TwentyOne\Actions\Markets;

use Illuminate\Support\Collection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

final class ResolveFeaturedMarketsGridDataAction
{
    /**
     * @return array{
     *     title:string,
     *     subtitle:string,
     *     showAllLink:string,
     *     showAllLabel:string,
     *     openMarketLabel:string,
     *     activeMarketsLabel:string,
     *     multiOutcomeLabel:string,
     *     visualOptionsLabel:string,
     *     freshnessLabel:string,
     *     educationLabel:string,
     *     emptyStateTitle:string,
     *     emptyStateBody:string,
     *     cards:Collection<int, array{
     *         title:string,
     *         slug:string,
     *         url:string,
     *         image_url:string|null,
     *         category:string|null,
     *         participants:int,
     *         volume:float,
     *         ends_at_human:string|null,
     *         outcomes:array<int, array{title:string, percentage:float, image_url:string|null}>
     *     }>
     * }
     */
    public function execute(?string $title = null, ?string $subtitle = null, ?string $showAllLink = null, int $limit = 12): array
    {
        $locale = app()->getLocale();

        return [
            'title' => $title ?? $this->tx('predict::home.featured_markets.title', 'Mercati in evidenza'),
            'subtitle' => $subtitle ?? $this->tx('predict::home.featured_markets.subtitle', 'Scopri i mercati più attivi'),
            'showAllLink' => $showAllLink ?? $this->resolveShowAllLink($locale),
            'showAllLabel' => $this->tx('predict::home.featured_markets.cta_all', 'Vedi tutti'),
            'openMarketLabel' => $this->tx('predict::actions.trade_market', 'Apri mercato'),
            'activeMarketsLabel' => $this->tx('predict::home.featured_markets.active_markets', 'Mercati attivi'),
            'multiOutcomeLabel' => $this->tx('predict::home.featured_markets.multi_outcome_focus', 'Multi-esito'),
            'visualOptionsLabel' => $this->tx('predict::home.featured_markets.visual_options', 'Opzioni visuali'),
            'freshnessLabel' => $this->tx('predict::home.featured_markets.freshness', 'Aggiornati di recente'),
            'educationLabel' => $this->tx('predict::home.featured_markets.education', 'Impara a prevedere'),
            'emptyStateTitle' => $this->tx('predict::predict_table.empty_state.no_markets_available.message', 'Nessun mercato disponibile'),
            'emptyStateBody' => $this->tx('predict::home.featured_markets.empty_body', 'Torna presto per scoprire nuovi mercati.'),
            'cards' => $this->resolveCards($limit),
        ];
    }

    /**
     * @return Collection<int, array{
     *     title:string,
     *     slug:string,
     *     url:string,
     *     image_url:string|null,
     *     category:string|null,
     *     participants:int,
     *     volume:float,
     *     ends_at_human:string|null,
     *     outcomes:array<int, array{title:string, percentage:float, image_url:string|null}>
     * }>
     */
    private function resolveCards(int $limit): Collection
    {
        unset($limit);

        /** @var Collection<int, array{
         *     title:string,
         *     slug:string,
         *     url:string,
         *     image_url:string|null,
         *     category:string|null,
         *     participants:int,
         *     volume:float,
         *     ends_at_human:string|null,
         *     outcomes:array<int, array{title:string, percentage:float, image_url:string|null}>
         * }> $empty */
        $empty = new Collection;

        return $empty;
    }

    private function resolveShowAllLink(string $locale): string
    {
        $localized = LaravelLocalization::getLocalizedURL($locale, '/predicts');

        if (is_string($localized) && $localized !== '') {
            return $localized;
        }

        return url('/'.$locale.'/predicts');
    }

    private function tx(string $key, string $fallback): string
    {
        $translated = __($key);
        if (is_string($translated) && $translated !== $key) {
            return $translated;
        }

        $translatedLabel = __($key.'.label');
        if (is_string($translatedLabel) && $translatedLabel !== $key.'.label') {
            return $translatedLabel;
        }

        return $fallback;
    }
}
