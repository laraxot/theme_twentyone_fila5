<?php
use function Laravel\Folio\{name};

name('home');
?>
<x-layouts.app
    title="Prevedi il Futuro"
    meta-description="La piattaforma di prediction market dove le tue previsioni contano."
>
    @volt('home')
    <div>
        <x-page side="content" slug="home"  />
    </div>
    @endvolt
</x-layouts.app>
