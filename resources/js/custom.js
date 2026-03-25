import focus from "@alpinejs/focus";
Alpine.plugin(focus);

<<<<<<< .merge_file_RlVudB
/* ============================================================
 * Utilities
 * ============================================================ */

function formatDate(dateString, options = { year: "numeric", month: "short", day: "numeric" }) {
    if (typeof dateString !== "string") return `'${dateString}' is not a string!`;
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return "Invalid date";
    return new Intl.DateTimeFormat("en-US", options).format(date);
}

function formatCurrency(number, locales = "en-US", options = {}) {
    return new Intl.NumberFormat(locales, options).format(number);
}

function remainingTime(dateString) {
    if (typeof dateString !== "string") return `'${dateString}' is not a string!`;
    const targetDate = new Date(dateString);
    if (isNaN(targetDate.getTime())) return "Invalid date";
    const differenceMs = Math.abs(targetDate - new Date());
    const hours = Math.floor(differenceMs / (1000 * 60 * 60));
    const minutes = Math.floor((differenceMs % (1000 * 60 * 60)) / (1000 * 60));
    return new Intl.DateTimeFormat("en", { hour: "numeric", minute: "numeric" })
        .format(new Date(0, 0, 0, hours, minutes));
}

/* ============================================================
 * Scroll Reveal — IntersectionObserver
 * ============================================================ */
function initScrollReveal() {
    // Respect prefers-reduced-motion
    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (prefersReducedMotion) {
        // Make all reveal elements visible immediately
        document.querySelectorAll(".reveal").forEach(el => el.classList.add("is-visible"));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target); // fire once
                }
            });
        },
        { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
    );

    document.querySelectorAll(".reveal").forEach(el => observer.observe(el));

    // Re-scan for dynamically added elements (Livewire updates)
    document.addEventListener("livewire:navigated", () => {
        document.querySelectorAll(".reveal:not(.is-visible)").forEach(el => observer.observe(el));
    });
}

/* ============================================================
 * Animated Counter — counts up to a target number
 * Usage: <span x-data="counter(12345)" x-text="display"></span>
 * ============================================================ */
function animateCounter(element, target, duration = 1500) {
    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (prefersReducedMotion) {
        element.textContent = formatCurrency(target);
        return;
    }

    const start = performance.now();
    const startVal = 0;

    function update(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        // ease-out cubic
        const eased = 1 - Math.pow(1 - progress, 3);
        const current = Math.floor(startVal + (target - startVal) * eased);
        element.textContent = formatCurrency(current);
        if (progress < 1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
}

/* ============================================================
 * Page entrance fade
 * ============================================================ */
function initPageTransition() {
    const main = document.querySelector("main, [data-page-content]");
    if (main) {
        main.classList.add("page-enter");
    }
}

/* ============================================================
 * Alpine init
 * ============================================================ */
document.addEventListener("alpine:init", () => {

    Alpine.store("screenWidth", window.innerWidth);
    Alpine.store("scrollingup", false);
    Alpine.store("scrollY", 0);

    let lastScrollTop = 0;
    window.addEventListener("scroll", () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        Alpine.store("scrollingup", scrollTop > lastScrollTop);
        Alpine.store("scrollY", scrollTop);
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, { passive: true });

    new ResizeObserver((entries) => {
        Alpine.store("screenWidth", entries[0].contentRect.width);
    }).observe(document.body);

    /* --------------------------------------------------------
     * Prediction market data components
     * -------------------------------------------------------- */
    Alpine.data("playmarkets", () => ({
        currentFilter: "All",
        filters: ["All", "Reserved Only"],
        markets: getMarkets(),
        postMarkets: getPostMarkets(),
        get isOneCol() { return this.$store.screenWidth < 768; },
        get oddMarkets() { return this.markets.filter((_, i) => i % 2 === 0); },
        get evenMarkets() { return this.markets.filter((_, i) => i % 2 !== 0); },
    }));

    Alpine.data("searchbar", () => ({
        search: "",
        markets: getMarkets(),
        get categories() {
            return this.markets.flatMap(m => m.category)
                .filter(c => c.title.toLowerCase().includes(this.search.toLowerCase()));
        },
        get tags() {
            return this.markets.flatMap(m => m.tags)
                .filter(t => t.name.toLowerCase().includes(this.search.toLowerCase()));
        },
        get filteredMarkets() {
            return this.markets.filter(i => i.title.toLowerCase().includes(this.search.toLowerCase()));
        },
    }));

    Alpine.data("heroslider", () => ({
        init() {
            this.swiper = new Swiper(this.$refs.swiper, {
                slidesPerView: 1,
                loop: true,
                autoplay: { delay: 5000 },
                pagination: { el: ".swiper-pagination", type: "bullets" },
            });
        },
        slides: getBanners(),
        swiper: null,
    }));

    /* --------------------------------------------------------
     * Animated stat counter
     * Usage: <div x-data="statCounter(12345)">
     *          <span x-text="display" class="stat-number"></span>
     *        </div>
     * -------------------------------------------------------- */
    Alpine.data("statCounter", (target, duration = 1400, prefix = "", suffix = "") => ({
        display: prefix + "0" + suffix,
        target,
        prefix,
        suffix,
        init() {
            const prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
            if (prefersReduced) {
                this.display = this.prefix + formatCurrency(this.target) + this.suffix;
                return;
            }

            // Observe when this element enters viewport
            const observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting) {
                    observer.disconnect();
                    this._animate();
                }
            }, { threshold: 0.3 });
            observer.observe(this.$el);
        },
        _animate() {
            const start = performance.now();
            const run = (now) => {
                const t = Math.min((now - start) / this.duration, 1);
                const eased = 1 - Math.pow(1 - t, 3);
                const val = Math.floor(this.target * eased);
                this.display = this.prefix + formatCurrency(val) + this.suffix;
                if (t < 1) requestAnimationFrame(run);
            };
            requestAnimationFrame(run);
        },
        duration,
    }));

    /* --------------------------------------------------------
     * Progress bar animated on scroll-into-view
     * Usage: <div x-data="progressBar(75)">
     *          <div class="progress-bar" :style="style"></div>
     *        </div>
     * -------------------------------------------------------- */
    Alpine.data("progressBar", (percent) => ({
        percent,
        width: "0%",
        style: "width: 0%",
        init() {
            const prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
            if (prefersReduced) {
                this.style = `width: ${this.percent}%`;
                return;
            }
            const observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting) {
                    observer.disconnect();
                    setTimeout(() => { this.style = `width: ${this.percent}%; transition: width 1s cubic-bezier(0.4,0,0.2,1)`; }, 100);
                }
            }, { threshold: 0.3 });
            observer.observe(this.$el);
        },
    }));

    /* --------------------------------------------------------
     * Toast notification system
     * -------------------------------------------------------- */
    Alpine.data("toastManager", () => ({
        toasts: [],
        add(message, type = "info", duration = 4000) {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            setTimeout(() => this.remove(id), duration);
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        },
    }));

});

/* ============================================================
 * Bootstrap after DOM ready
 * ============================================================ */
document.addEventListener("DOMContentLoaded", () => {
    initScrollReveal();
    initPageTransition();
});

/* ============================================================
 * Stubs for server-rendered data injection
 * ============================================================ */
function getBanners() { return []; }
function getMarkets() { return []; }
function getPostMarkets() { return []; }
=======
// Minimal custom.js for build
console.log('Custom JS loaded');
>>>>>>> .merge_file_M3BsfO
