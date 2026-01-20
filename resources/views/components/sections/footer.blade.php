<footer class="py-8 text-white bg-gray-900 xl:py-16">
    <div class="container max-w-6xl mx-auto space-y-6">
        @php
            $logo = array_slice($blocks, 0, 1)[0];
            $social = array_slice($blocks, 1, 1)[0];
            $footer_links = array_slice($blocks, 2, 1)[0];
        @endphp
        @include($logo->view, $logo->data)
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="space-y-6">
                <div class="space-y-2">
                </div>
                @include($social->view, $social->data)
                <div class="flex items-center gap-6">
                    <div class="grid text-sm text-gray-900 bg-white rounded place-items-center size-8">
                        <span>18+</span>
                    </div>
                </div>
            </div>
            <div>
                @include($footer_links->view, $footer_links->data)
            </div>
        </div>
    </div>
</footer>