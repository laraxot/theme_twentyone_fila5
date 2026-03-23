@php
    $locales = [
        'it' => 'Italiano',
        'en' => 'English',
    ];

    $base = str_replace(url('/'), '', url()->full());
    $base = \Illuminate\Support\Str::of($base)->after('/' . $lang)->toString();
@endphp

<div class="relative">
    <details class="group">
        <summary class="list-none cursor-pointer py-3 text-sm font-semibold">
            <span class="inline-flex items-center gap-2">
                <span>{{ $locales[$lang] ?? strtoupper($lang) }}</span>
                <x-heroicon-o-chevron-down class="size-4 transition group-open:rotate-180" />
            </span>
        </summary>
        <div class="absolute right-0 z-50 mt-2 min-w-[10rem] rounded-lg border border-slate-200 bg-white p-2 shadow-lg dark:border-slate-700 dark:bg-slate-900">
            @foreach($locales as $key => $locale)
                <a href="{{ url('/' . $key . $base) }}" class="block rounded px-3 py-2 text-sm hover:bg-slate-100 dark:hover:bg-slate-800">
                    {{ $locale }}
                </a>
            @endforeach
        </div>
    </details>
</div>