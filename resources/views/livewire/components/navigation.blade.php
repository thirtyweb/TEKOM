<div>
    <div>
        <nav class="bg-gray-900/60 backdrop-blur-xl border-b border-green-400/20 shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0 flex items-center">
                        <a wire:navigate href="{{ route('home') }}" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 rounded-md border-2 border-green-400/50 flex items-center justify-center text-green-400 font-bold text-2xl group-hover:bg-green-400/10 group-hover:shadow-[0_0_15px_rgba(52,211,153,0.5)] transition-all duration-300">
                                T
                            </div>
                            <span class="text-xl font-bold font-mono text-green-300 group-hover:text-green-400 group-hover:drop-shadow-[0_0_5px_rgba(52,211,153,0.7)] transition-all duration-300">TEKOMSS</span>
                        </a>
                    </div>
    
                    <div class="hidden md:flex items-center space-x-8">
                        <a wire:navigate href="{{ route('home') }}" class="font-mono text-sm text-gray-300 hover:text-green-300 transition-colors duration-200 tracking-wider">
                            // BERANDA
                        </a>
    
                        <div class="relative group">
                            <button class="flex items-center font-mono text-sm text-gray-300 hover:text-green-300 transition-colors duration-200 tracking-wider">
                                <span>// ARTIKEL</span>
                                <svg class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:rotate-180 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-3 w-56 origin-top-right bg-gray-900/90 backdrop-blur-lg border border-green-400/20 rounded-lg shadow-2xl opacity-0 scale-95 invisible group-hover:opacity-100 group-hover:scale-100 group-hover:visible transition-all duration-200 transform-gpu z-50">
                                <div class="p-1">
                                    <a wire:navigate href="{{ route('articles.index') }}" class="block px-4 py-2 text-sm font-mono text-gray-300 hover:bg-green-500/10 hover:text-green-300 rounded-md transition-colors duration-150">Semua Artikel</a>
                                    @foreach($categories as $category)
                                        <a wire:navigate href="{{ route('articles.index', ['categoryId' => $category->id]) }}" class="block px-4 py-2 text-sm font-mono text-gray-300 hover:bg-green-500/10 hover:text-green-300 rounded-md transition-colors duration-150">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
    
                        <a wire:navigate href="{{ route('gallery.index') }}" class="font-mono text-sm text-gray-300 hover:text-green-300 transition-colors duration-200 tracking-wider">// GALERI</a>
                        <a wire:navigate href="{{ route('resources.index') }}" class="font-mono text-sm text-gray-300 hover:text-green-300 transition-colors duration-200 tracking-wider">// RESOURCE</a>
                        <a wire:navigate href="{{ route('courses.index') }}" class="font-mono text-sm text-gray-300 hover:text-green-300 transition-colors duration-200 tracking-wider">// COURSES</a>
                        <a wire:navigate href="{{ route('faq.index') }}" class="font-mono text-sm text-gray-300 hover:text-green-300 transition-colors duration-200 tracking-wider">// FAQ</a>
                    </div>
    
                    <div class="md:hidden">
                        <button id="mobileMenuButton" class="text-green-300 hover:text-green-400 focus:outline-none transition-colors duration-200">
                            <svg id="hamburgerIcon" class="h-6 w-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg id="closeIcon" class="h-6 w-6 hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
    
            <div id="mobileMenu" class="md:hidden hidden bg-gray-900/95 backdrop-blur-lg border-t border-green-400/20">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a wire:navigate href="{{ route('home') }}" class="block px-3 py-2 font-mono text-sm text-gray-300 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-200 tracking-wider">
                        // BERANDA
                    </a>
                    
                    <div class="relative">
                        <button id="mobileArtikelButton" class="w-full flex items-center justify-between px-3 py-2 font-mono text-sm text-gray-300 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-200 tracking-wider">
                            <span>// ARTIKEL</span>
                            <svg id="mobileArtikelIcon" class="w-4 h-4 transition-transform duration-200 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="mobileArtikelDropdown" class="hidden pl-6 mt-1 space-y-1">
                            <a wire:navigate href="{{ route('articles.index') }}" class="block px-3 py-2 text-sm font-mono text-gray-400 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-150">Semua Artikel</a>
                            @foreach($categories as $category)
                                <a wire:navigate href="{{ route('articles.index', ['categoryId' => $category->id]) }}" class="block px-3 py-2 text-sm font-mono text-gray-400 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-150">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    
                    <a wire:navigate href="{{ route('gallery.index') }}" class="block px-3 py-2 font-mono text-sm text-gray-300 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-200 tracking-wider">
                        // GALERI
                    </a>
                    <a wire:navigate href="{{ route('resources.index') }}" class="block px-3 py-2 font-mono text-sm text-gray-300 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-200 tracking-wider">
                        // RESOURCE
                    </a>
                    <a wire:navigate href="{{ route('courses.index') }}" class="block px-3 py-2 font-mono text-sm text-gray-300 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-200 tracking-wider">
                        // COURSES
                    </a>
                    <a wire:navigate href="{{ route('faq.index') }}" class="block px-3 py-2 font-mono text-sm text-gray-300 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-200 tracking-wider">
                        // FAQ
                    </a>
                </div>
            </div>
        </nav>
        
    </div>
    <script>
        // Wrap dalam IIFE untuk mencegah konflik dengan Livewire
        (function() {
            'use strict';
            
            function initializeMobileMenu() {
                const mobileMenuButton = document.getElementById('mobileMenuButton');
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburgerIcon = document.getElementById('hamburgerIcon');
                const closeIcon = document.getElementById('closeIcon');
                const mobileArtikelButton = document.getElementById('mobileArtikelButton');
                const mobileArtikelDropdown = document.getElementById('mobileArtikelDropdown');
                const mobileArtikelIcon = document.getElementById('mobileArtikelIcon');
                
                // Check if elements exist before adding event listeners
                if (!mobileMenuButton || !mobileMenu) return;
                
                // Remove existing event listeners jika ada
                mobileMenuButton.replaceWith(mobileMenuButton.cloneNode(true));
                if (mobileArtikelButton) {
                    mobileArtikelButton.replaceWith(mobileArtikelButton.cloneNode(true));
                }
                
                // Get fresh references after cloning
                const newMobileMenuButton = document.getElementById('mobileMenuButton');
                const newMobileArtikelButton = document.getElementById('mobileArtikelButton');
                
                // Mobile menu toggle
                newMobileMenuButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isHidden = mobileMenu.classList.contains('hidden');
                    
                    if (isHidden) {
                        mobileMenu.classList.remove('hidden');
                        if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
                        if (closeIcon) closeIcon.classList.remove('hidden');
                    } else {
                        mobileMenu.classList.add('hidden');
                        if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                        if (closeIcon) closeIcon.classList.add('hidden');
                    }
                });
                
                // Mobile artikel dropdown
                if (newMobileArtikelButton && mobileArtikelDropdown && mobileArtikelIcon) {
                    newMobileArtikelButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        const isHidden = mobileArtikelDropdown.classList.contains('hidden');
                        
                        if (isHidden) {
                            mobileArtikelDropdown.classList.remove('hidden');
                            mobileArtikelIcon.style.transform = 'rotate(180deg)';
                        } else {
                            mobileArtikelDropdown.classList.add('hidden');
                            mobileArtikelIcon.style.transform = 'rotate(0deg)';
                        }
                    });
                }
            }
            
            // Close mobile menu when clicking outside
            function handleOutsideClick(event) {
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburgerIcon = document.getElementById('hamburgerIcon');
                const closeIcon = document.getElementById('closeIcon');
                const mobileArtikelDropdown = document.getElementById('mobileArtikelDropdown');
                const mobileArtikelIcon = document.getElementById('mobileArtikelIcon');
                
                if (!mobileMenu) return;
                
                const isClickInsideNav = event.target.closest('nav');
                if (!isClickInsideNav && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                    if (closeIcon) closeIcon.classList.add('hidden');
                    if (mobileArtikelDropdown) mobileArtikelDropdown.classList.add('hidden');
                    if (mobileArtikelIcon) mobileArtikelIcon.style.transform = 'rotate(0deg)';
                }
            }
            
            // Close mobile menu when window is resized to desktop
            function handleResize() {
                if (window.innerWidth >= 768) {
                    const mobileMenu = document.getElementById('mobileMenu');
                    const hamburgerIcon = document.getElementById('hamburgerIcon');
                    const closeIcon = document.getElementById('closeIcon');
                    const mobileArtikelDropdown = document.getElementById('mobileArtikelDropdown');
                    const mobileArtikelIcon = document.getElementById('mobileArtikelIcon');
                    
                    if (mobileMenu) mobileMenu.classList.add('hidden');
                    if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                    if (closeIcon) closeIcon.classList.add('hidden');
                    if (mobileArtikelDropdown) mobileArtikelDropdown.classList.add('hidden');
                    if (mobileArtikelIcon) mobileArtikelIcon.style.transform = 'rotate(0deg)';
                }
            }
            
            // Initialize on DOM ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initializeMobileMenu);
            } else {
                initializeMobileMenu();
            }
            
            // Re-initialize after Livewire navigation
            document.addEventListener('livewire:navigated', initializeMobileMenu);
            
            // Clear any intervals that might be running
            document.addEventListener('livewire:navigating', function() {
                // Clear any running intervals to prevent errors
                const highestId = window.setTimeout(() => {
                    for (let i = highestId; i >= 0; i--) {
                        window.clearInterval(i);
                    }
                }, 0);
            });
            
            // Global event listeners
            document.removeEventListener('click', handleOutsideClick);
            document.addEventListener('click', handleOutsideClick);
            
            window.removeEventListener('resize', handleResize);
            window.addEventListener('resize', handleResize);
            
        })();
    </script>
</div>