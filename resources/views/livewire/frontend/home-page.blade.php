    <div>
        <div class="space-y-20 bg-black bg-[linear-gradient(to_right,rgba(0,255,0,0.05)_1px,transparent_1px),linear-gradient(to_bottom,rgba(0,255,0,0.05)_1px,transparent_1px)] bg-[size:2rem_2rem] text-gray-300 overflow-hidden">

            @if ($banners->count() > 0)
                <section
                    class="relative mx-4 md:mx-10 mt-8 overflow-hidden border-2 border-green-500/30 shadow-[0_0_40px_rgba(52,211,153,0.1)] rounded-lg transform perspective-1000 -rotate-x-1 duration-1000 transition-all ease-out"
                    data-aos="zoom-in" data-aos-duration="1200" data-aos-easing="ease-in-out-back">
                    <div class="absolute inset-0 z-10 opacity-10 pointer-events-none"
                        style="background: repeating-linear-gradient(0deg, rgba(0,0,0,0.5), rgba(0,0,0,0.5) 1px, transparent 1px, transparent 2px);">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent z-20"></div>
        
                    <livewire:components.slideshow lazy />
        
                    <div class="absolute bottom-6 left-6 md:bottom-10 md:left-10 z-30">
                        <p class="font-mono text-sm text-green-400 animate-pulse drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">Departemen Teknik Komputer & Sains</p>
                        <h1
                            class="text-3xl md:text-5xl font-bold text-white mt-2 drop-shadow-[0_2px_15px_rgba(52,211,153,0.6)]"
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                            Inovasi Teknologi Masa Depan
                        </h1>
                    </div>
                </section>
            @endif
        
            <section class="py-16 md:py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12 md:mb-16" data-aos="fade-zoom-in" data-aos-duration="1000">
                        <h2 class="text-3xl md:text-4xl font-bold text-green-300 mb-4 relative inline-block">
                            Sekilas Tentang Kami
                            <span class="absolute left-1/2 transform -translate-x-1/2 bottom-0 w-24 h-1 bg-green-500 rounded-full opacity-70 animate-shine"></span>
                        </h2>
                        <p class="text-base md:text-lg text-gray-500 max-w-3xl mx-auto mt-4">
                            {{ $aboutUsData->about_us_description ?? 'Tekom adalah prodi yang berdedikasi untuk menjadi yang terdepan dalam inovasi teknologi, pendidikan, dan penelitian. Kami membentuk talenta digital masa depan.' }}
                        </p>
                    </div>
            
                    <div class="grid lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 border border-gray-800 bg-gray-900/40 p-6 rounded-lg backdrop-blur-sm shadow-xl hover:shadow-[0_0_50px_rgba(52,211,153,0.2)] transition-all duration-500"
                            data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200" data-aos-easing="ease-out-quad">
                            <h3 class="text-2xl font-semibold text-green-300 mb-4 border-b border-green-700/50 pb-2">Visi Kami</h3>
                            <p class="text-gray-300 text-lg italic leading-relaxed">
                                "{{ $aboutUsData->vision_text ?? 'Menjadi pusat unggulan global dalam rekayasa teknologi dan komputasi yang memberikan dampak signifikan bagi peradaban.' }}"</p>
                        </div>
            
                        <div class="border border-gray-800 bg-gray-900/40 p-6 rounded-lg backdrop-blur-sm shadow-xl hover:shadow-[0_0_50px_rgba(52,211,153,0.2)] transition-all duration-500"
                            data-aos="fade-left" data-aos-duration="1200" data-aos-delay="400" data-aos-easing="ease-out-quad">
                            <h3 class="text-2xl font-semibold text-green-300 mb-4 border-b border-green-700/50 pb-2">Fakta & Angka</h3>
                            <div class="space-y-4 pt-2">
                                @forelse ($aboutUsData->facts ?? [] as $fact)
                                    <div class="flex justify-between items-baseline {{ !$loop->last ? 'border-b border-gray-700/50 pb-2' : '' }}">
                                        <span class="text-gray-400 text-lg">{{ $fact['label'] }}</span>
                                        <span class="font-mono text-3xl font-bold text-white text-shadow-glow">{{ $fact['value'] }}</span>
                                    </div>
                                @empty
                                    {{-- Default facts jika tidak ada data dari admin --}}
                                    <div class="flex justify-between items-baseline border-b border-gray-700/50 pb-2">
                                        <span class="text-gray-400 text-lg">Mahasiswa Aktif</span>
                                        <span class="font-mono text-3xl font-bold text-white text-shadow-glow">1,200+</span>
                                    </div>
                                    <div class="flex justify-between items-baseline border-b border-gray-700/50 pb-2">
                                        <span class="text-gray-400 text-lg">Publikasi Ilmiah</span>
                                        <span class="font-mono text-3xl font-bold text-white text-shadow-glow">350+</span>
                                    </div>
                                    <div class="flex justify-between items-baseline">
                                        <span class="text-gray-400 text-lg">Mitra Industri</span>
                                        <span class="font-mono text-3xl font-bold text-white text-shadow-glow">50+</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
            
                        <div class="lg:col-span-3 border border-gray-800 bg-gray-900/40 p-6 rounded-lg backdrop-blur-sm shadow-xl hover:shadow-[0_0_50px_rgba(52,211,153,0.2)] transition-all duration-500"
                            data-aos="fade-up" data-aos-duration="1200" data-aos-delay="600" data-aos-easing="ease-out-quad">
                            <h3 class="text-2xl font-semibold text-green-300 mb-4 border-b border-green-700/50 pb-2">Misi Kami</h3>
                            <ul class="space-y-3 pt-2">
                                @forelse ($aboutUsData->mission_items ?? [] as $mission)
                                    <li class="flex items-start">
                                        <span class="text-green-400 mr-3 mt-1 text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">&raquo;</span>
                                        <span class="text-gray-400 text-base leading-relaxed">{{ $mission['mission_point'] }}</span>
                                    </li>
                                @empty
                                    <li class="flex items-start">
                                        <span class="text-green-400 mr-3 mt-1 text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">&raquo;</span>
                                        <span class="text-gray-400 text-base leading-relaxed">Menyelenggarakan pendidikan berkualitas tinggi yang terintegrasi dengan riset terdepan dan kebutuhan industri global.</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-green-400 mr-3 mt-1 text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">&raquo;</span>
                                        <span class="text-gray-400 text-base leading-relaxed">Mengembangkan inovasi disruptif melalui penelitian interdisipliner yang berorientasi pada solusi nyata.</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-green-400 mr-3 mt-1 text-xl drop-shadow-[0_0_5px_rgba(0,255,0,0.5)]">&raquo;</span>
                                        <span class="text-gray-400 text-base leading-relaxed">Membangun ekosistem akademis yang dinamis, kolaboratif, dan inklusif untuk mendorong pertumbuhan talenta.</span>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        
            @if ($galleries->count() > 0)
                <section class="py-16 md:py-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12 md:mb-16" data-aos="fade-zoom-in" data-aos-duration="1000">
                            <h2 class="text-3xl md:text-4xl font-bold text-green-300 mb-4 relative inline-block">
                                Galeri Kegiatan
                                <span class="absolute left-1/2 transform -translate-x-1/2 bottom-0 w-24 h-1 bg-green-500 rounded-full opacity-70 animate-shine"></span>
                            </h2>
                            <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto mt-4">
                                Jelajahi momen-momen terbaik yang telah kami abadikan dalam koleksi foto pilihan.
                            </p>
                        </div>
        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-12 md:mb-16">
                            @foreach ($galleries as $index => $gallery)
                                <div wire:key="gallery-{{ $gallery->id }}"
                                    class="group relative overflow-hidden rounded-lg border border-green-500/30 bg-gray-900/50 p-1 shadow-lg
                                            transform transition-all duration-500 ease-out hover:scale-102 hover:shadow-[0_0_35px_rgba(52,211,153,0.4)] hover:border-green-500/80"
                                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ $index * 120 }}" data-aos-easing="ease-out-back">
                                    <div class="relative aspect-[4/3] overflow-hidden rounded-md">
                                        @if (!empty($gallery->images) && is_array($gallery->images))
                                            <img src="{{ asset('storage/' . $gallery->images[0]) }}"
                                                alt="{{ $gallery->title }}"
                                                class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 filter grayscale group-hover:grayscale-0 group-hover:brightness-110">
                                        @else
                                            <div class="w-full h-full bg-black flex items-center justify-center">
                                                <i class="fas fa-signal-slash text-4xl text-gray-800"></i>
                                            </div>
                                        @endif
        
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-100 group-hover:opacity-100 transition-opacity duration-500"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out">
                                            <h3
                                                class="text-xl font-bold text-white transition-colors duration-300 group-hover:text-green-400 drop-shadow-[0_0_10px_rgba(0,255,0,0.3)]">
                                                {{ $gallery->title }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
        
                        <div class="text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ ($galleries->count() * 100) + 200 }}">
                            <a wire:navigate href="{{ route('gallery.index') }}"
                            class="relative inline-flex items-center px-10 py-4 bg-green-600 text-black font-extrabold rounded-full shadow-lg overflow-hidden
                                    hover:bg-green-500 transition-all duration-500 ease-in-out group transform hover:scale-105
                                    before:content-[''] before:absolute before:inset-0 before:bg-gradient-to-r before:from-green-400 before:to-green-700 before:opacity-0 group-hover:before:opacity-100 before:transition-opacity before:duration-500">
                            <span class="relative z-10 text-white group-hover:text-black transition-colors duration-300">Lihat Semua Galeri</span>
                            <span class="absolute right-4 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-full group-hover:translate-x-0">
                                <i class="fas fa-arrow-right text-black"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </section>
            @endif
        
            @if ($quoteOfTheDay)
                <section class="py-12 md:py-16 relative overflow-hidden quote-section" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="100">
                    <div class="absolute inset-0 bg-black/70 backdrop-blur-md animate-twinkle"></div>
                    {{-- New element for twinkling dots --}}
                    <div class="absolute inset-0 z-0 twinkling-lines-bg"></div>
                    {{-- End new element --}}
                    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                        <div class="border-t border-b border-green-500/20 py-10 px-4 bg-gray-900/30 rounded-xl backdrop-blur-sm shadow-2xl relative overflow-hidden">
                            <div class="absolute inset-0 z-0 opacity-5" style="background: repeating-linear-gradient(-45deg, rgba(0,255,0,0.1), rgba(0,255,0,0.1) 2px, transparent 2px, transparent 8px);"></div>
                            
                            <i class="fas fa-quote-left text-5xl text-green-400 mb-6 relative z-10 drop-shadow-[0_0_10px_rgba(0,255,0,0.5)]"></i>
                            <blockquote class="text-xl md:text-2xl font-medium text-gray-200 italic relative z-10 leading-relaxed">
                                "{{ $quoteOfTheDay->quote }}"
                            </blockquote>
                            @if ($quoteOfTheDay->author)
                                <footer class="mt-8 text-base text-gray-500 relative z-10">— <span class="font-semibold text-green-400">{{ $quoteOfTheDay->author }}</span></footer>
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        
            @if ($featuredArticles->count() > 0)
                <section class="py-16 md:py-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12 md:mb-16" data-aos="fade-zoom-in" data-aos-duration="1000">
                            <h2 class="text-3xl md:text-4xl font-bold text-green-300 mb-4 relative inline-block">
                                Artikel & Wawasan
                                <span class="absolute left-1/2 transform -translate-x-1/2 bottom-0 w-24 h-1 bg-green-500 rounded-full opacity-70 animate-shine"></span>
                            </h2>
                            <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto mt-4">
                                Temukan informasi, wawasan, dan pemikiran terbaru dari komunitas akademik kami.
                            </p>
                        </div>
        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($featuredArticles as $index => $article)
                                <article wire:key="article-{{ $article->id }}"
                                        class="group flex flex-col bg-gray-900/50 border border-gray-800 rounded-lg overflow-hidden shadow-xl
                                                hover:border-green-500/70 transition-all duration-500 ease-out hover:scale-102 hover:shadow-[0_0_35px_rgba(52,211,153,0.3)]"
                                        data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ $index * 150 }}" data-aos-easing="ease-out-back">
                                    @if ($article->featured_image)
                                        <div class="aspect-[16/9] overflow-hidden relative">
                                            <a wire:navigate href="{{ route('articles.show', $article) }}">
                                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                                    alt="{{ $article->title }}"
                                                    class="w-full h-full object-cover transition-all duration-700 opacity-60 group-hover:opacity-90 group-hover:scale-110 filter brightness-90 group-hover:brightness-110">
                                            </a>
                                            <div class="absolute top-2 left-2 w-6 h-6 border-t-2 border-l-2 border-green-400/70 scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                                            <div class="absolute bottom-2 right-2 w-6 h-6 border-b-2 border-r-2 border-green-400/70 scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                                        </div>
                                    @endif
        
                                    <div class="p-5 flex flex-col flex-grow">
                                        <div class="mb-3">
                                            <span class="text-xs font-semibold text-green-400 opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                                                Kategori: {{ $article->category->name }}
                                            </span>
                                        </div>
        
                                        <h3 class="text-xl font-bold text-gray-200 mb-4 flex-grow group-hover:text-green-300 transition-colors duration-200 leading-snug">
                                            <a wire:navigate href="{{ route('articles.show', $article) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h3>
                                        
                                        <div class="mt-auto pt-4 flex items-center justify-between text-xs text-gray-500 border-t border-gray-700/50 pt-3">
                                            <span>Oleh: <span class="font-medium text-gray-400">{{ $article->author->name }}</span></span>
                                            <span><i class="far fa-calendar-alt text-green-500 mr-1"></i>{{ $article->published_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        </div>
        
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('livewire:navigated', () => {
                AOS.init({
                    once: true, // Animation should happen only once - while scrolling down
                    mirror: false, // Elements should NOT animate out while scrolling past them
                    duration: 1000, // Default duration for AOS animations
                    easing: 'ease-out-quad', // Default easing for AOS animations
                });
                AOS.refresh(); // Refresh AOS when Livewire navigation occurs to detect new elements
            });
        
            // Also initialize on initial page load (for first visit or hard refresh)
            document.addEventListener('DOMContentLoaded', () => {
                AOS.init({
                    once: true,
                    mirror: false,
                    duration: 1000,
                    easing: 'ease-out-quad',
                });
            });
        </script>
        
        <style>
            /* Custom Tailwind utility for text glow */
            .text-shadow-glow {
                text-shadow: 0 0 8px rgba(0, 255, 0, 0.6), 0 0 15px rgba(0, 255, 0, 0.3);
            }
        
            /* Pulse animation for the small text and quote icon */
            .animate-pulse {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: .6;
                }
            }
        
            /* Shine effect for section titles */
            .animate-shine {
                animation: shine 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
            @keyframes shine {
                0%, 100% {
                    transform: translateX(-100%);
                }
                50% {
                    transform: translateX(100%);
                }
            }
        
            /* Additional transformations for Hero section */
            .perspective-1000 {
                perspective: 1000px;
            }
            .-rotate-x-1 {
                transform: rotateX(-1deg);
            }
        
            /* Custom scrollbar for a futuristic feel (optional) */
            ::-webkit-scrollbar {
                width: 8px;
            }
        
            ::-webkit-scrollbar-track {
                background: #1a1a1a; /* Dark track */
            }
        
            ::-webkit-scrollbar-thumb {
                background: #0f8f0f; /* Green thumb */
                border-radius: 4px;
            }
        
            ::-webkit-scrollbar-thumb:hover {
                background: #0ad30a; /* Lighter green on hover */
            }
        
            /* Twinkle animation for quote background */
            @keyframes twinkle {
                0%, 100% { opacity: 0.7; transform: scale(1); }
                50% { opacity: 0.9; transform: scale(1.02); }
            }
        
            .animate-twinkle {
                animation: twinkle 5s linear infinite;
            }
        
            /* Twinkling lines animation */
            .twinkling-lines-bg {
                position: absolute;
                inset: 0;
                z-index: 0;
                background: 
                    linear-gradient(135deg, rgba(0, 255, 0, 0.4) 2px, transparent 3px),
                    linear-gradient(45deg, rgba(0, 255, 0, 0.4) 2px, transparent 3px);
                background-size: 40px 40px; /* Adjust line density */
                animation: line-twinkle 10s infinite alternate, line-move 60s linear infinite;
                opacity: 0.3;
            }
        
            @keyframes line-twinkle {
                0% { opacity: 0.3; }
                25% { opacity: 0.8; }
                50% { opacity: 0.4; }
                75% { opacity: 0.9; }
                100% { opacity: 0.3; }
            }
        
            @keyframes line-move {
                0% { background-position: 0 0, 0 0; }
                100% { background-position: 400px 400px, -400px -400px; } /* Adjust for speed and direction */
            }
        </style>
    </div>