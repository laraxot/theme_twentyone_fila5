<button 
    x-data="{
        darkMode: $persist(false).as('dark_mode'),
        toggleDarkMode(){
            document.documentElement.classList.toggle('dark');
            if(document.documentElement.classList.contains('dark')){
                this.darkMode = true;
            } else {
                this.darkMode = false;
            }
        }
    }" 
    @click="toggleDarkMode()"
    x-init="
        if(document.documentElement.classList.contains('dark')){ darkMode=true; }
    "
    class="w-full h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 hover:text-gray-600 dark:hover:bg-gray-800 dark:text-gray-300 dark:hover:text-gray-100 transition-colors duration-200 rounded-full"
    aria-label="Toggle dark mode"
    title="Toggle dark mode"
>
    <svg x-show="!darkMode" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 13.5v1.5m9.75-4.5h-1.5m-13.5 0h-1.5M12 18.75a6.75 6.75 0 110-13.5 6.75 6.75 0 010 13.5z" />
    </svg>
    <svg x-show="darkMode" x-cloak class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 21c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843-4.582" />
    </svg>
</button>