<footer class="py-8 text-white bg-gray-900 xl:py-16">
    <div class="container max-w-6xl mx-auto space-y-6">
        @php
            $logo = array_slice($blocks, 0, 1)[0];
            $footer_links = array_slice($blocks, 1, 1)[0];
        @endphp
        @include($logo->view, $logo->data)
        <div class="flex items-center justify-between gap-6">
            @include($footer_links->view, $footer_links->data)
            <div class="flex items-center gap-6">
                <div class="grid text-sm text-gray-900 bg-white rounded place-items-center size-8">
                    <span>18+</span>
                </div>
            </div>
        </div>
    </div>
</footer>