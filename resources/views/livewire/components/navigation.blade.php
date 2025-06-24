
<div>
    <nav class="bg-gray-900/60 backdrop-blur-xl border-b border-green-400/20 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- [UBAH] Logo didesain ulang dengan font mono dan aksen neon -->
                <div class="flex-shrink-0 flex items-center">
                    <a wire:navigate href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <!-- Kotak logo dengan border neon dan efek glitch kecil saat di-hover -->
                        <div class="w-10 h-10 rounded-md border-2 border-green-400/50 flex items-center justify-center text-green-400 font-bold text-2xl group-hover:bg-green-400/10 group-hover:shadow-[0_0_15px_rgba(52,211,153,0.5)] transition-all duration-300">
                            R
                        </div>
                        <!-- Teks logo dengan font mono dan efek glow -->
                        <span class="text-xl font-bold font-mono text-green-300 group-hover:text-green-400 group-hover:drop-shadow-[0_0_5px_rgba(52,211,153,0.7)] transition-all duration-300">TEKOMSS</span>
                    </a>
                </div>

                <!-- [UBAH] Desktop Navigation dengan gaya baru -->
                <div class="hidden md:flex items-center space-x-8">
                    <!-- Setiap link kini menggunakan font mono dan efek hover yang unik -->
                    <a wire:navigate href="{{ route('home') }}" class="font-mono text-sm text-gray-300 hover:text-green-300 transition-colors duration-200 tracking-wider">
                        // BERANDA
                    </a>

                    <!-- Artikel Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center font-mono text-sm text-gray-300 hover:text-green-300 transition-colors duration-200 tracking-wider">
                            <span>// ARTIKEL</span>
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:rotate-180 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- [UBAH] Menu dropdown dengan tema gelap -->
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

                <!-- [UBAH] Icon menu mobile dengan warna neon -->
                <div class="md:hidden">
                    <button class="text-green-300 hover:text-green-400 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</div>
