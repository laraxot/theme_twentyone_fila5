<footer class="py-8 bg-white dark:bg-gray-900 border-t border-slate-200 dark:border-slate-800 text-slate-800 dark:text-white xl:py-16 transition-colors duration-300">
    <div class="container max-w-6xl mx-auto space-y-6 px-4 sm:px-6">
        @php
            $footerLinks = array_values(array_filter(
                $blocks,
                static fn ($block): bool => str_contains((string) $block->view, 'footer_links')
            ));
            $footerLinksBlock = $footerLinks[0] ?? null;
        @endphp

        <div class="space-y-4">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div class="space-y-1">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ config('app.name') }}</p>
                    <p class="max-w-xl text-sm text-slate-500 dark:text-gray-400">
                        Prediction market con crediti virtuali a tappi di bottiglia, mercati chiari e regole trasparenti.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="grid text-sm font-semibold text-white dark:text-gray-900 bg-slate-900 dark:bg-white rounded place-items-center size-8">
                        <span>18+</span>
                    </div>
                    <div class="w-[38px] h-[38px] overflow-hidden rounded-full">
                        <x-ui.light-dark-switch></x-ui.light-dark-switch>
                    </div>
                </div>
            </div>

            @if ($footerLinksBlock !== null)
                <div class="flex flex-col gap-6 border-t border-slate-200 dark:border-white/10 pt-4 md:flex-row md:items-start md:justify-between">
                    @include($footerLinksBlock->view, $footerLinksBlock->data)
                </div>
            @endif
        </div>
    </div>
</footer>
