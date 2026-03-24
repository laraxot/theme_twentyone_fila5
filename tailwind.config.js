/** @type {import('tailwindcss').Config} */
export default {
	darkMode: 'class',
	content: [
		'./resources/**/*.{html,js,blade.php}',
		'./resources/views/**/*.blade.php',
		'../../Modules/**/Filament/**/*.php',
		'../../Modules/**/resources/views/**/*.blade.php',
		'../../resources/views/filament/**/*.blade.php',
		'../../vendor/filament/**/*.blade.php',
		'../../resources/views/**/*.blade.php',
		'../../storage/framework/views/*.php',
		'../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./node_modules/flowbite/**/*.js',
		'./node_modules/preline/preline.js',
		'./node_modules/daisyui/**/*.js',
	],
	theme: {
		fontFamily: {
			sans: ["Figtree", "ui-sans-serif", "system-ui", "sans-serif", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"],
>>>>>>> origin/dev
		},
		extend: {
			colors: {
				// Prediction market color scheme
				'market': {
<<<<<<< HEAD
					'yes': '#10b981',
					'no': '#ef4444',
					'neutral': '#6b7280',
				},
				'probability': {
					'high': '#059669',
					'medium': '#d97706',
					'low': '#dc2626',
				}
			},
			keyframes: {
				'fade-in-up': {
					'0%': { opacity: '0', transform: 'translateY(20px)' },
					'100%': { opacity: '1', transform: 'translateY(0)' },
				},
				'fade-in': {
					'0%': { opacity: '0' },
					'100%': { opacity: '1' },
				},
				'slide-in-left': {
					'0%': { opacity: '0', transform: 'translateX(-24px)' },
					'100%': { opacity: '1', transform: 'translateX(0)' },
				},
				'slide-in-right': {
					'0%': { opacity: '0', transform: 'translateX(24px)' },
					'100%': { opacity: '1', transform: 'translateX(0)' },
				},
				'float': {
					'0%, 100%': { transform: 'translateY(0px)' },
					'50%': { transform: 'translateY(-10px)' },
				},
				'shimmer': {
					'0%': { backgroundPosition: '-200% 0' },
					'100%': { backgroundPosition: '200% 0' },
				},
				'scale-in': {
					'0%': { opacity: '0', transform: 'scale(0.95)' },
					'100%': { opacity: '1', transform: 'scale(1)' },
				},
				'bar-grow': {
					'0%': { width: '0%' },
					'100%': { width: 'var(--bar-width)' },
				},
			},
			animation: {
				'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
				'bounce-in': 'bounceIn 0.5s ease-out',
				'fade-in-up': 'fade-in-up 0.6s ease-out both',
				'fade-in': 'fade-in 0.5s ease-out both',
				'slide-in-left': 'slide-in-left 0.6s ease-out both',
				'slide-in-right': 'slide-in-right 0.6s ease-out both',
				'float': 'float 4s ease-in-out infinite',
				'shimmer': 'shimmer 2s linear infinite',
				'scale-in': 'scale-in 0.4s ease-out both',
				'bar-grow': 'bar-grow 1s ease-out both',
			},
			transitionDelay: {
				'100': '100ms',
				'200': '200ms',
				'300': '300ms',
				'400': '400ms',
				'500': '500ms',
				'600': '600ms',
				'700': '700ms',
				'800': '800ms',
			},
		},
	},
}
=======
					'yes': '#10b981',      // green-500
					'no': '#ef4444',       // red-500
					'neutral': '#6b7280',  // gray-500
				},
				'probability': {
					'high': '#059669',     // emerald-600
					'medium': '#d97706',   // amber-600
					'low': '#dc2626',      // red-600
				}
			},
			animation: {
				'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
				'bounce-in': 'bounceIn 0.5s ease-out',
				'kinetic-float': 'float 6s ease-in-out infinite',
			},
			keyframes: {
				float: {
					'0%, 100%': { transform: 'translateY(0)' },
					'50%': { transform: 'translateY(-20px)' },
				}
			}
		},
	},
	plugins: [
		require('daisyui'),
		require('flowbite/plugin')(),
		require('preline/plugin'),
	],
	daisyui: {
		themes: ['light', 'dark', 'synthwave', 'cyberpunk'],
		darkTheme: 'synthwave',
		base: true,
		styled: true,
		utils: true,
		prefix: '',
		logs: false,
		themeRoot: ':root',
	},
}