import "flowbite";

import Swiper from "swiper/bundle";
window.Swiper = Swiper;
/*
import "./cookie-consent.js";
*/
import "./custom.js";
import { initCinematicParticles } from "./particles.js";

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

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        revealKineticBlocks();
        initAntigravityFields();
        initCinematicParticles();
    }, { once: true });
} else {
    revealKineticBlocks();
    initAntigravityFields();
    initCinematicParticles();
}
