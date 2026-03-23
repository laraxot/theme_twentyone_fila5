// Dark Mode Toggle - TwentyOne Theme
// Adds dark mode toggle functionality with localStorage persistence

const initDarkMode = () => {
    const toggle = document.getElementById('dark-mode-toggle');
    const html = document.documentElement;
    
    if (!toggle) {
        return;
    }

    // Check localStorage or system preference
    const getPreferredTheme = () => {
        const stored = localStorage.getItem('theme');
        if (stored) {
            return stored;
        }
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    // Apply theme
    const applyTheme = (theme) => {
        if (theme === 'dark') {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    };

    // Initialize
    applyTheme(getPreferredTheme());

    // Toggle click
    toggle.addEventListener('click', () => {
        const isDark = html.classList.contains('dark');
        applyTheme(isDark ? 'light' : 'dark');
        
        // Animate icon
        const sunIcon = toggle.querySelector('[data-icon="sun"]');
        const moonIcon = toggle.querySelector('[data-icon="moon"]');
        
        if (sunIcon && moonIcon) {
            sunIcon.classList.toggle('hidden');
            moonIcon.classList.toggle('hidden');
        }
    });

    // Listen for system changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
            applyTheme(e.matches ? 'dark' : 'light');
        }
    });
};

// Export for use in app.js
export { initDarkMode };
