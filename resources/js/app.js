import "flowbite";

import Swiper from "swiper/bundle";
window.Swiper = Swiper;

// Alpine.js is initialized by Livewire/Filament scripts in this theme layout.
// Do not start Alpine manually here, otherwise Filament table helpers can be undefined.

/*
import "./cookie-consent.js";
*/
import "./custom.js";
import { initCinematicParticles } from "./particles.js";
import { initDarkMode } from "./dark-mode.js";

// ============================================
// GSAP & ScrollTrigger Configuration
// ============================================

import { gsap } from "./gsap-config.js";
import { ScrollTrigger } from "./scroll-trigger-config.js";

// Export per uso globale (opzionale, per debug o uso esterno)
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// ============================================
// TradingView Lightweight Charts
// ============================================

import { createTradingViewChart, formatChartData, initTradingViewCharts } from "./components/tradingview-chart.js";

// Export per uso globale (per moduli che usano window.gsap pattern)
window.createTradingViewChart = createTradingViewChart;
window.formatChartData = formatChartData;

// ============================================
// Kinetic Web Design - Interactions
// ============================================

const revealKineticBlocks = () => {
    const blocks = document.querySelectorAll('[data-kinetic-block].reveal-kinetic');

    if (!blocks.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        blocks.forEach((block) => block.classList.add('visible'));
        return;
    }

    const observer = new IntersectionObserver((entries, currentObserver) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('visible');
            currentObserver.unobserve(entry.target);
        });
    }, {
        rootMargin: '0px 0px -8% 0px',
        threshold: 0.12,
    });

    blocks.forEach((block) => observer.observe(block));
};

const initCounterAnimation = () => {
    const counters = document.querySelectorAll('[data-kinetic-counter]');

    if (!counters.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const animateCounter = (element) => {
        const target = parseInt(element.dataset.counterTarget, 10) || 0;
        const duration = parseInt(element.dataset.counterDuration, 10) || 2000;
        const counterValue = element.querySelector('.counter-value');

        if (!counterValue) {
            return;
        }

        if (prefersReducedMotion) {
            return;
        }

        const prefix = counterValue.dataset.prefix || '';
        const suffix = counterValue.dataset.suffix || '';
        const startTimestamp = performance.now();
        const startValue = 0;

        const step = (timestamp) => {
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const currentValue = Math.floor(startValue + (target - startValue) * easeOutQuart);

            counterValue.textContent = prefix + currentValue.toLocaleString() + suffix;

            if (progress < 1) {
                requestAnimationFrame(step);
            }
        };

        requestAnimationFrame(step);
    };

    if (prefersReducedMotion) {
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, {
        rootMargin: '0px 0px -10% 0px',
        threshold: 0.1,
    });

    counters.forEach((counter) => observer.observe(counter));
};

const initAntigravityFields = () => {
    const fields = document.querySelectorAll('[data-antigravity-field]');

    if (!fields.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    fields.forEach((field) => {
        const resetPointer = () => {
            field.style.setProperty('--ag-pointer-x', '50%');
            field.style.setProperty('--ag-pointer-y', '50%');
        };

        if (prefersReducedMotion) {
            resetPointer();
            return;
        }

        const updatePointer = (event) => {
            const rect = field.getBoundingClientRect();
            const relativeX = ((event.clientX - rect.left) / rect.width) * 100;
            const relativeY = ((event.clientY - rect.top) / rect.height) * 100;

            field.style.setProperty('--ag-pointer-x', `${Math.max(0, Math.min(100, relativeX))}%`);
            field.style.setProperty('--ag-pointer-y', `${Math.max(0, Math.min(100, relativeY))}%`);
        };

        resetPointer();
        field.addEventListener('pointermove', updatePointer, { passive: true });
        field.addEventListener('pointerleave', resetPointer, { passive: true });
    });
};

// ============================================
// GSAP Count-up Animation (for stats)
// ============================================

const initGSAPCountUp = () => {
    if (!gsap) {
        return;
    }

    const countUpElements = document.querySelectorAll('.count-up');

    if (!countUpElements.length) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (prefersReducedMotion) {
        countUpElements.forEach(el => {
            const target = parseInt(el.getAttribute('data-target'));
            el.innerText = target;
        });
        return;
    }

    countUpElements.forEach(el => {
        const target = parseInt(el.getAttribute('data-target'));

        gsap.to(el, {
            innerText: target,
            duration: 2,
            scrollTrigger: {
                trigger: el,
                start: 'top 80%',
            },
            snap: { innerText: 1 },
            ease: 'power2.out',
            onUpdate: function() {
                el.innerText = Math.ceil(this.targets()[0].innerText);
            }
        });
    });
};

// ============================================
// Cookie Consent - GDPR Compliant
// ============================================

const initCookieConsent = () => {
    const consentBanner = document.getElementById('cookie-consent');
    
    if (!consentBanner) {
        return;
    }

    const acceptButton = document.getElementById('accept-cookies');
    const declineButton = document.getElementById('decline-cookies');

    // Check if user has already made a choice
    const cookieConsent = localStorage.getItem('cookie-consent');
    
    if (!cookieConsent) {
        // Show banner after page load
        setTimeout(() => {
            consentBanner.classList.remove('hidden');
        }, 1000);
    }

    // Handle accept button
    if (acceptButton) {
        acceptButton.addEventListener('click', function() {
            localStorage.setItem('cookie-consent', 'accepted');
            consentBanner.classList.add('hidden');

            // Enable GA4
            if (typeof gtag === 'function') {
                gtag('consent', 'update', {
                    'analytics_storage': 'granted'
                });
            }
        });
    }

    // Handle decline button
    if (declineButton) {
        declineButton.addEventListener('click', function() {
            localStorage.setItem('cookie-consent', 'declined');
            consentBanner.classList.add('hidden');

            // Disable GA4
            if (typeof gtag === 'function') {
                gtag('consent', 'update', {
                    'analytics_storage': 'denied',
                    'ad_storage': 'denied'
                });
            }
        });
    }
};

// ============================================
// Initialize on DOM Ready
// ============================================

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        revealKineticBlocks();
        initAntigravityFields();
        initCinematicParticles();
        initCounterAnimation();
        initGSAPCountUp();
        initCookieConsent(); // Cookie Consent
        initDarkMode(); // Dark Mode Toggle
        initTradingViewCharts(); // TradingView Charts
    }, { once: true });
} else {
    revealKineticBlocks();
    initAntigravityFields();
    initCinematicParticles();
    initCounterAnimation();
    initGSAPCountUp();
    initCookieConsent(); // Cookie Consent
    initDarkMode(); // Dark Mode Toggle
    initTradingViewCharts(); // TradingView Charts
}
