{{--
    View: user::filament.widgets.login
    Scopo: Widget di login Filament conforme a Windsurf/Xot
    Modifica liberamente questa struttura per UX custom
--}}
<div class="filament-widget-login space-y-6">
    <?php $allErrors = $errors->all(); ?>
    @if ($allErrors !== [])
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
            @foreach ($allErrors as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form wire:submit.prevent="login" class="space-y-4">
        {{ $this->form }}
        <button type="submit" class="w-full py-3 rounded bg-[#FF5F7E] text-white font-bold">
            {{ __('Accedi') }}
            <x-filament::loading-indicator class="h-5 w-5" wire:loading/>
        </button>
    </form>
    <div class="text-center text-sm text-gray-500 mt-2">
        <a href="{{ route('password.request') }}" class="underline hover:text-blue-700">{{ __('Password dimenticata?') }}</a>
    </div>
</div>
