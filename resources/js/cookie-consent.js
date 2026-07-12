/**
 * Cookie consent banner (vanilla-cookieconsent) for TwentyOne FO.
 * Categories: necessary (readonly), analytics optional.
 * @see docs/wiki/overviews/twentyone-theme.md
 */
import * as CookieConsent from "vanilla-cookieconsent";
import { enPreferenceSections } from "./cookie-consent-sections.js";

CookieConsent.run({
	categories: {
		necessary: { enabled: true, readOnly: true },
		functionality: { enabled: true },
		analytics: { enabled: true },
		marketings: { enabled: true },
	},
	guiOptions: {
		consentModal: {
			layout: "cloud inline",
			position: "bottom center",
			flipButtons: false,
			equalWeightButtons: true,
		},
		preferencesModal: {
			layout: "box",
			flipButtons: false,
			equalWeightButtons: true,
		},
	},
	language: {
		default: "en",
		translations: {
			en: {
				consentModal: {
					title: "Cookie Consent",
					description: "We use cookies to make our site work and also for analytics and advertising purposes. See our Cookie Policy for more details.",
					acceptAllBtn: "Accept all",
					acceptNecessaryBtn: "Reject all",
					showPreferencesBtn: "Manage preferences",
				},
				preferencesModal: {
					title: "Manage cookie preferences",
					acceptAllBtn: "Accept all",
					acceptNecessaryBtn: "Reject all",
					savePreferencesBtn: "Accept current selection",
					closeIconLabel: "Close modal",
					sections: enPreferenceSections,
				},
			},
		},
	},
});
