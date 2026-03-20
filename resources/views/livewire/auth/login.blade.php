<div class="grid min-h-screen md:grid-cols-2">
    <div class="hidden bg-[#0F2734] p-16 text-white md:block">
        <div class="flex h-full flex-col justify-between">
            <a href="{{ url('/' . app()->getLocale()) }}">
                <img src="{{ asset('assets/predict/img/logo-ft.svg') }}" alt="{{ config('app.name') }}" class="h-8 w-auto" />
            </a>

            <div class="space-y-4">
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-300">Bentornato</p>
                <h1 class="text-[56px] font-semibold leading-tight">Accedi a Predict</h1>
                <p class="max-w-md text-lg text-slate-300">
                    Entra nel tuo account per seguire i mercati, consultare i risultati e piazzare nuove previsioni.
                </p>
            </div>
        </div>
    </div>

    <div class="relative bg-[#ECEFED]">
        <main class="container mx-auto max-w-md px-5 py-16">
            <div class="space-y-6">
                <h2 class="text-center text-3xl font-semibold text-slate-950">Accedi</h2>

                <a
                    href="{{ route('socialite.', ['provider' => 'google']) }}"
                    class="flex w-full items-center rounded-lg border border-slate-400 px-4 py-4 font-semibold transition-colors duration-200 hover:bg-white"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.18em" height="1.2em" viewBox="0 0 256 262" aria-hidden="true">
                        <path fill="#4285f4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" />
                        <path fill="#34a853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" />
                        <path fill="#fbbc05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" />
                        <path fill="#eb4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" />
                    </svg>
                    <span class="grow text-center tracking-widest">Continua con Google</span>
                </a>

                <div class="flex items-center py-2">
                    <div class="flex-1 border-t border-slate-400"></div>
                    <span class="px-3 text-sm text-slate-800">oppure</span>
                    <div class="flex-1 border-t border-slate-400"></div>
                </div>

                <form class="space-y-4" wire:submit.prevent="authenticate">
                    <div class="space-y-1">
                        <label for="email" class="block font-semibold">E-mail</label>
                        <input wire:model.lazy="email" id="email" type="email" class="block h-14 w-full rounded-lg border border-slate-400 bg-transparent p-4 transition hover:border-slate-300 hover:bg-slate-300 focus:border-slate-400 focus:bg-transparent" placeholder="nome@dominio.it" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="block font-semibold">Password</label>
                        <input wire:model.lazy="password" id="password" type="password" class="block h-14 w-full rounded-lg border border-slate-400 bg-transparent p-4 transition hover:border-slate-300 hover:bg-slate-300 focus:border-slate-400 focus:bg-transparent" />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="flex w-full items-center rounded-lg bg-[#0027cc] px-4 py-4 font-semibold text-white transition-colors duration-200 hover:bg-[#061989]">
                        <span class="grow text-center tracking-widest">Accedi</span>
                    </button>

                    <div class="text-center">
                        <a class="font-semibold text-[#0027cc]" href="{{ route('password.request') }}">Hai dimenticato la password?</a>
                    </div>
                </form>

                @if (Route::has('register'))
                    <div class="text-center font-semibold">
                        <span>Non hai ancora un account?</span>
                        <a class="text-[#0027cc]" href="{{ url('/' . app()->getLocale() . '/auth/register') }}">Registrati</a>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
