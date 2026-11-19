<?php
use function Laravel\Folio\{name};

name('privacy');
?>
<x-layouts.app
    :title="__('pub_theme::page_privacy.page.title.title')"
    :meta-description="__('pub_theme::page_privacy.page.meta_description.description')"
>
    <div class="min-h-screen bg-slate-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm p-8">
                <h1 class="text-4xl font-bold text-slate-900 mb-8">{{ __('pub_theme::page_privacy.page.heading.title') }}</h1>

                <div class="prose prose-slate max-w-none">
                    <p class="text-lg text-slate-600 mb-6">
                        {{ __('pub_theme::page_privacy.page.intro.description') }}
                    </p>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.holder.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        Predict S.r.l.<br>
                        {{ __('pub_theme::page_privacy.contact.address.label') }} Via Example 123, 00100 Roma, Italia<br>
                        {{ __('pub_theme::page_privacy.contact.email.label') }} privacy@predict.it<br>
                        {{ __('pub_theme::page_privacy.holder.vat.label') }} 12345678901
                    </p>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.data.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">{{ __('pub_theme::page_privacy.data.intro.description') }}</p>
                    <ul class="list-disc list-inside text-slate-600 mb-4">
                        <li><strong>{{ __('pub_theme::page_privacy.data.registration_label.label') }}</strong> {{ __('pub_theme::page_privacy.data.registration_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.data.usage_label.label') }}</strong> {{ __('pub_theme::page_privacy.data.usage_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.data.technical_label.label') }}</strong> {{ __('pub_theme::page_privacy.data.technical_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.data.cookies_label.label') }}</strong> {{ __('pub_theme::page_privacy.data.cookies_text.description') }}</li>
                    </ul>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.purposes.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">{{ __('pub_theme::page_privacy.purposes.intro.description') }}</p>
                    <ul class="list-disc list-inside text-slate-600 mb-4">
                        <li>{{ __('pub_theme::page_privacy.purposes.item_service.label') }}</li>
                        <li>{{ __('pub_theme::page_privacy.purposes.item_account.label') }}</li>
                        <li>{{ __('pub_theme::page_privacy.purposes.item_improve.label') }}</li>
                        <li>{{ __('pub_theme::page_privacy.purposes.item_comms.label') }}</li>
                        <li>{{ __('pub_theme::page_privacy.purposes.item_analytics.label') }}</li>
                    </ul>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.legal_basis.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        {{ __('pub_theme::page_privacy.legal_basis.intro.description') }}
                    </p>
                    <ul class="list-disc list-inside text-slate-600 mb-4">
                        <li><strong>{{ __('pub_theme::page_privacy.legal_basis.contract_label.label') }}</strong> {{ __('pub_theme::page_privacy.legal_basis.contract_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.legal_basis.consent_label.label') }}</strong> {{ __('pub_theme::page_privacy.legal_basis.consent_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.legal_basis.interest_label.label') }}</strong> {{ __('pub_theme::page_privacy.legal_basis.interest_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.legal_basis.law_label.label') }}</strong> {{ __('pub_theme::page_privacy.legal_basis.law_text.description') }}</li>
                    </ul>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.sharing.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        {{ __('pub_theme::page_privacy.sharing.intro.description') }}
                    </p>
                    <ul class="list-disc list-inside text-slate-600 mb-4">
                        <li>{{ __('pub_theme::page_privacy.sharing.item_providers.label') }}</li>
                        <li>{{ __('pub_theme::page_privacy.sharing.item_law.label') }}</li>
                        <li>{{ __('pub_theme::page_privacy.sharing.item_merger.label') }}</li>
                    </ul>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.transfers.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        {{ __('pub_theme::page_privacy.transfers.intro.description') }}
                    </p>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.security.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        {{ __('pub_theme::page_privacy.security.intro.description') }}
                    </p>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.retention.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        {{ __('pub_theme::page_privacy.retention.intro.description') }}
                    </p>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.rights.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">{{ __('pub_theme::page_privacy.rights.intro.description') }}</p>
                    <ul class="list-disc list-inside text-slate-600 mb-4">
                        <li><strong>{{ __('pub_theme::page_privacy.rights.access_label.label') }}</strong> {{ __('pub_theme::page_privacy.rights.access_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.rights.rectification_label.label') }}</strong> {{ __('pub_theme::page_privacy.rights.rectification_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.rights.erasure_label.label') }}</strong> {{ __('pub_theme::page_privacy.rights.erasure_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.rights.portability_label.label') }}</strong> {{ __('pub_theme::page_privacy.rights.portability_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.rights.objection_label.label') }}</strong> {{ __('pub_theme::page_privacy.rights.objection_text.description') }}</li>
                        <li><strong>{{ __('pub_theme::page_privacy.rights.restriction_label.label') }}</strong> {{ __('pub_theme::page_privacy.rights.restriction_text.description') }}</li>
                    </ul>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.cookies.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        {{ __('pub_theme::page_privacy.cookies.intro.description') }}
                    </p>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.changes.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        {{ __('pub_theme::page_privacy.changes.intro.description') }}
                    </p>

                    <h2 class="text-2xl font-semibold text-slate-900 mt-8 mb-4">{{ __('pub_theme::page_privacy.contacts.title.title') }}</h2>
                    <p class="text-slate-600 mb-4">
                        {{ __('pub_theme::page_privacy.contacts.intro.description') }}
                    </p>
                    <ul class="list-disc list-inside text-slate-600 mb-4">
                        <li>{{ __('pub_theme::page_privacy.contact.email.label') }} privacy@predict.it</li>
                        <li>{{ __('pub_theme::page_privacy.contact.address.label') }} Via Example 123, 00100 Roma, Italia</li>
                        <li>{{ __('pub_theme::page_privacy.contact.dpo.label') }} dpo@predict.it</li>
                    </ul>

                    <div class="mt-8 p-4 bg-slate-50 rounded-lg">
                        <p class="text-sm text-slate-500">
                            {{ __('pub_theme::page_privacy.footer.updated.label') }} {{ date('d/m/Y') }}<br>
                            {{ __('pub_theme::page_privacy.footer.compliance.description') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
