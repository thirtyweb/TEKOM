<!-- Latar belakang utama diubah menjadi hitam pekat dengan pola grid hijau halus -->
<div class="space-y-20 bg-black bg-[linear-gradient(to_right,rgba(0,255,0,0.05)_1px,transparent_1px),linear-gradient(to_bottom,rgba(0,255,0,0.05)_1px,transparent_1px)] bg-[size:2rem_2rem] text-gray-300">

    <!-- Hero/Slideshow Section -->
    @if ($banners->count() > 0)
        <section class="relative mx-4 md:mx-10 mt-8 overflow-hidden border-2 border-green-500/30 shadow-[0_0_40px_rgba(52,211,153,0.1)] rounded-none">
            <!-- Efek Scanline tetap dipertahankan -->
            <div class="absolute inset-0 z-10 opacity-10 pointer-events-none" style="background: repeating-linear-gradient(0deg, rgba(0,0,0,0.5), rgba(0,0,0,0.5) 1px, transparent 1px, transparent 2px);"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent z-20"></div>
            
            <livewire:components.slideshow />

            <!-- [UBAH] Teks diubah menjadi lebih elegan dan profesional -->
            <div class="absolute bottom-6 left-6 md:bottom-10 md:left-10 z-30">
                <p class="font-mono text-sm text-green-400 animate-pulse">Departemen Teknik Komputer & Sains</p>
                <h1 class="text-3xl md:text-5xl font-bold text-white mt-2 drop-shadow-[0_2px_10px_rgba(52,211,153,0.4)]">
                    Inovasi Teknologi Masa Depan
                </h1>
            </div>
        </section>
    @endif

    <!-- Section Tentang Kami, Visi & Misi -->
    <section class="py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- [UBAH] Judul section diubah menjadi lebih formal -->
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-green-300 mb-4 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]">
                    Sekilas Tentang Kami
                </h2>
                <p class="text-base md:text-lg text-gray-500 max-w-3xl mx-auto">
                    TEKOMSS adalah departemen yang berdedikasi untuk menjadi yang terdepan dalam inovasi teknologi, pendidikan, dan penelitian. Kami membentuk talenta digital masa depan.
                </p>
            </div>

            <!-- Grid untuk Visi, Misi, dan Statistik -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Panel Visi -->
                <div class="lg:col-span-2 border border-gray-800 bg-gray-900/40 p-6 rounded-lg">
                    <!-- [UBAH] Judul diubah -->
                    <h3 class="text-xl font-semibold text-green-300 mb-3">Visi Kami</h3>
                    <p class="text-gray-300 text-lg italic leading-relaxed">"Menjadi pusat unggulan global dalam rekayasa teknologi dan komputasi yang memberikan dampak signifikan bagi peradaban."</p>
                </div>
                
                <!-- Panel Statistik Kunci -->
                <div class="border border-gray-800 bg-gray-900/40 p-6 rounded-lg">
                    <!-- [UBAH] Judul diubah -->
                    <h3 class="text-xl font-semibold text-green-300 mb-4">Fakta & Angka</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-baseline">
                            <span class="text-gray-400">Mahasiswa Aktif</span>
                            <span class="font-mono text-2xl font-bold text-white">1,200+</span>
                        </div>
                         <div class="flex justify-between items-baseline">
                            <span class="text-gray-400">Publikasi Ilmiah</span>
                            <span class="font-mono text-2xl font-bold text-white">350+</span>
                        </div>
                         <div class="flex justify-between items-baseline">
                            <span class="text-gray-400">Mitra Industri</span>
                            <span class="font-mono text-2xl font-bold text-white">50+</span>
                        </div>
                    </div>
                </div>

                <!-- Panel Misi -->
                <div class="lg:col-span-3 border border-gray-800 bg-gray-900/40 p-6 rounded-lg">
                     <!-- [UBAH] Judul diubah -->
                     <h3 class="text-xl font-semibold text-green-300 mb-4">Misi Kami</h3>
                     <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="text-green-400 mr-3 mt-1">&gt;</span>
                            <span class="text-gray-400">Menyelenggarakan pendidikan berkualitas tinggi yang terintegrasi dengan riset terdepan dan kebutuhan industri global.</span>
                        </li>
                         <li class="flex items-start">
                            <span class="text-green-400 mr-3 mt-1">&gt;</span>
                            <span class="text-gray-400">Mengembangkan inovasi disruptif melalui penelitian interdisipliner yang berorientasi pada solusi nyata.</span>
                        </li>
                         <li class="flex items-start">
                            <span class="text-green-400 mr-3 mt-1">&gt;</span>
                            <span class="text-gray-400">Membangun ekosistem akademis yang dinamis, kolaboratif, dan inklusif untuk mendorong pertumbuhan talenta.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    @if ($galleries->count() > 0)
    <section class="py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <!-- [UBAH] Judul section diubah -->
                    <h2 class="text-3xl md:text-4xl font-bold text-green-300 mb-4 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]">
                        Galeri Kegiatan
                    </h2>
                    <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto">
                        Jelajahi momen-momen terbaik yang telah kami abadikan dalam koleksi foto pilihan.
                    </p>
                </div>

                <!-- ... Loading State ... -->

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-12 md:mb-16">
                    @foreach ($galleries as $gallery)
                        <div wire:key="gallery-{{ $gallery->id }}" 
                             class="group relative overflow-hidden rounded-md border border-green-500/30 bg-gray-900/40 p-1 transition-all duration-300 hover:border-green-500/80 hover:shadow-[0_0_25px_rgba(52,211,153,0.25)]">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                @if (!empty($gallery->images) && is_array($gallery->images))
                                    <img src="{{ asset('storage/' . $gallery->images[0]) }}"
                                         alt="{{ $gallery->title }}"
                                         class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105 filter grayscale group-hover:grayscale-0">
                                @else
                                    <div class="w-full h-full bg-black flex items-center justify-center">
                                        <i class="fas fa-signal-slash text-4xl text-gray-800"></i>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h3 class="text-xl font-bold text-white transition-colors duration-300 group-hover:text-green-400">{{ $gallery->title }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <!-- [UBAH] Teks tombol diubah -->
                    <a wire:navigate href="{{ route('gallery.index') }}"
                       class="relative inline-flex items-center px-8 py-3 bg-green-600 text-black font-bold rounded-none hover:bg-green-500 transition-all duration-300 group">
                        <span class="absolute -inset-1 bg-green-500/50 blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative">Lihat Semua Galeri</span>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Quote of the Day -->
    @if ($quoteOfTheDay)
        <section class="py-12 md:py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="border-t border-b border-green-500/20 py-10 px-4">
                    <!-- [UBAH] Teks sistem dihapus -->
                    <i class="fas fa-quote-left text-4xl text-green-400 mb-6"></i>
                    <blockquote class="text-xl md:text-2xl font-medium text-gray-200 italic">
                        "{{ $quoteOfTheDay->quote }}"
                    </blockquote>
                    @if ($quoteOfTheDay->author)
                        <!-- [UBAH] Teks user diubah menjadi lebih formal -->
                        <footer class="mt-6 text-base text-gray-500">— {{ $quoteOfTheDay->author }}</footer>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Artikel Section -->
    @if ($featuredArticles->count() > 0)
        <section class="py-16 md:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <!-- [UBAH] Judul section diubah -->
                    <h2 class="text-3xl md:text-4xl font-bold text-green-300 mb-4 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]">
                        Artikel & Wawasan
                    </h2>
                    <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto">
                        Temukan informasi, wawasan, dan pemikiran terbaru dari komunitas akademik kami.
                    </p>
                </div>
                
                <!-- ... Loading state ... -->

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featuredArticles as $article)
                        <article wire:key="article-{{ $article->id }}" 
                                 class="group flex flex-col bg-gray-900/40 border border-gray-800 rounded-lg overflow-hidden hover:border-green-500/50 transition-colors duration-300">
                            @if ($article->featured_image)
                                <div class="aspect-[16/9] overflow-hidden relative">
                                    <a wire:navigate href="{{ route('articles.show', $article) }}">
                                        <img src="{{ asset('storage/' . $article->featured_image) }}"
                                             alt="{{ $article->title }}"
                                             class="w-full h-full object-cover transition-all duration-500 opacity-40 group-hover:opacity-70">
                                    </a>
                                    <div class="absolute top-2 left-2 w-5 h-5 border-t-2 border-l-2 border-green-400/70 transition-opacity duration-300 opacity-0 group-hover:opacity-100"></div>
                                    <div class="absolute bottom-2 right-2 w-5 h-5 border-b-2 border-r-2 border-green-400/70 transition-opacity duration-300 opacity-0 group-hover:opacity-100"></div>
                                </div>
                            @endif

                            <div class="p-5 flex flex-col flex-grow">
                                <div class="mb-3">
                                    <!-- [UBAH] Teks kategori diubah -->
                                    <span class="text-xs font-semibold text-green-400">
                                        Kategori: {{ $article->category->name }}
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-gray-200 mb-4 flex-grow group-hover:text-green-300 transition-colors duration-200">
                                    <a wire:navigate href="{{ route('articles.show', $article) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                
                                <div class="mt-auto pt-4 flex items-center justify-between text-xs text-gray-500">
                                    <!-- [UBAH] Info penulis dan tanggal dibuat lebih standar -->
                                    <span>Oleh: {{ $article->author->name }}</span>
                                    <span>{{ $article->published_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
