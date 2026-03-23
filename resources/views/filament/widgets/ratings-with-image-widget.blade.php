<?php
$selectedRatingId = $openRatingId;
$hasSelection = $selectedRatingId !== null && $selectedRatingId !== '';
$allRatings = is_iterable($ratings) ? $ratings : [];
?>
<div>
    <article class="bg-white p-6 lg:p-[18px] rounded-lg border flex flex-col xot-modal-place-bet overflow-hidden" style="max-height: 270px;">
        <?php if ($hasSelection): ?>
            <div class="p-4 bg-gray-100 rounded-lg flex flex-col gap-4">
                <h3 class="text-lg font-bold">Place bet</h3>
                <p class="text-sm text-gray-600">Selezione attiva: {{ $selectedRatingId }}</p>
                <button wire:click="$set('openRatingId', null)" class="flex items-center gap-2 text-blue-600 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rotate-180" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </button>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 flex-1 [grid-auto-rows:1fr]" style="height: 232px; max-height: 232px;">
                <?php foreach ($allRatings as $rating): ?>
                    <?php
                    $ratingId = $rating['id'] ?? null;
                    $ratingTitle = $rating['title'] ?? '';
                    $ratingImage = $rating['image'] ?? '';
                    $isActive = $rating_title === $ratingTitle;
                    $percentage = $ratings_percentage[$ratingId] ?? 0;
                    ?>
                    <button wire:click="$set('openRatingId', '{{ $ratingId }}')" class="relative block h-full overflow-hidden rounded-lg {{ $isActive ? 'border-[3px] border-blue-600 shadow-lg shadow-blue-300' : '' }}">
                        <figure class="h-full w-full">
                            <img class="object-cover w-full h-full" alt="{{ $ratingTitle }}" title="{{ $ratingTitle }}" src="{{ $ratingImage }}" loading="lazy" />
                        </figure>
                        <div class="absolute inset-0 transition bg-transparent hover:bg-blue-500/30"></div>
                        <div class="p-1.5 absolute inset-0 flex flex-col text-start justify-between pointer-events-none">
                            <div class="flex items-center justify-center h-8 rounded-sm bg-neutral-5 w-11 {{ $isActive ? 'text-white' : 'text-gray-400' }}">
                                <span>{{ $percentage }}%</span>
                            </div>
                            <p class="text-sm font-medium text-white leading-[1.1]">{{ $ratingTitle }}</p>
                        </div>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>
</div>
