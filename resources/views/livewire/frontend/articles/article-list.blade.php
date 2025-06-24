<!-- 
    File ini bisa Anda gunakan untuk menggantikan konten halaman Daftar Artikel Anda.
    Semua fungsionalitas Livewire dan Blade tetap sama, hanya kelas CSS yang diubah.
-->
<div>
    <!-- [UBAH] Latar belakang diubah agar menyatu dengan tema gelap -->
    <div class="min-h-screen pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 md:mb-12">
                <!-- [UBAH] Judul menggunakan font-mono dan warna neon -->
                <h1 class="text-3xl md:text-4xl font-bold font-mono text-green-300 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]">
                    &gt; INTEL_DATABASE
                </h1>
                <p class="text-gray-500 mt-2">Akses dan filter semua log data yang telah didekripsi.</p>
            </div>
            
            <!-- Filter & Search -->
            <!-- [UBAH] Panel filter didesain ulang menjadi "Query Interface" -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 p-4 border border-gray-800 bg-gray-900/40 rounded-lg">
                <div class="md:col-span-1">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Filter by keyword..." 
                           class="w-full px-4 py-2 border border-slate-700 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-slate-800 text-gray-300 placeholder-gray-500">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:col-span-2 gap-4">
                    <select wire:model.live="categoryId" class="w-full px-4 py-2 border border-slate-700 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-slate-800 text-gray-300">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="sortBy" class="w-full px-4 py-2 border border-slate-700 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-slate-800 text-gray-300">
                        <option value="latest">Sort by: Terbaru</option>
                        <option value="oldest">Sort by: Terlama</option>
                        <option value="popular">Sort by: Terpopuler</option>
                    </select>
                </div>
            </div>
        
        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <!-- [UBAH] Menggunakan desain kartu artikel yang konsisten dengan homepage -->
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
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-mono text-green-400">
                                // TOPIC: {{ $article->category->name }}
                            </span>
                            <span class="text-xs text-gray-500 font-mono">
                                {{ $article->views }} views
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-200 mb-4 flex-grow group-hover:text-green-300 transition-colors duration-200">
                            <a wire:navigate href="{{ route('articles.show', $article) }}">
                                {{ $article->title }}
                            </a>
                        </h3>
                        
                        @if($article->excerpt)
                            <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                                {{ Str::limit($article->excerpt, 100) }}
                            </p>
                        @endif
                        
                        <div class="mt-auto pt-4 border-t border-gray-800 flex items-center justify-between text-xs text-gray-500 font-mono">
                            <span>SOURCE: {{ $article->author->name }}</span>
                            <span>DATE: {{ $article->published_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-satellite-dish text-gray-700 text-6xl mb-4"></i>
                        <h3 class="text-xl font-mono text-gray-400 mb-2">
                            // NO DATA MATCHING QUERY
                        </h3>
                        <p class="text-gray-500">
                            Tidak ada intelijen yang cocok dengan parameter filter Anda.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if ($articles->hasPages())
            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

    <!-- [BARU] Custom Styles untuk pagination di tema gelap -->
    <style>
        .pagination {
            @apply flex justify-center space-x-1;
        }
        .pagination .page-link, 
        .pagination .page-item.disabled .page-link,
        .pagination .page-item .page-link[rel='next'],
        .pagination .page-item .page-link[rel='prev'] {
            @apply px-4 py-2 text-sm font-mono text-gray-400 bg-gray-900/40 border border-gray-800 rounded-md hover:bg-gray-800/60 hover:text-green-300 transition-colors duration-200;
        }
        .pagination .page-item.active .page-link {
            @apply bg-green-500/20 text-green-300 border-green-500/50 cursor-default;
        }
        .pagination .page-item.disabled .page-link {
            @apply text-gray-700 cursor-not-allowed hover:bg-gray-900/40 hover:text-gray-700;
        }
    </style>
</div>
