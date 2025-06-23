<div class="space-y-20">
    <!-- Hero/Slideshow Section -->
    @if ($banners->count() > 0)
        <section class="relative mx-4 md:mx-10 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-indigo-600/20 z-10"></div>
            <livewire:components.slideshow />
            <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent z-20"></div>
        </section>
    @endif

    <!-- Gallery Section -->
    @if ($galleries->count() > 0)
        <section class="py-16 md:py-20 bg-gradient-to-br from-gray-50 to-blue-50/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <span class="inline-block px-3 py-1 text-xs md:text-sm font-medium text-blue-600 bg-blue-100 rounded-full mb-3 md:mb-4">
                        Moment Terbaik
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Galeri Kami
                        </span>
                    </h2>
                    <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                        Jelajahi momen-momen terbaik yang telah kami abadikan dalam koleksi foto pilihan
                    </p>
                </div>

                <!-- Loading State -->
                <div wire:loading.delay class="text-center py-8">
                    <div class="inline-flex items-center text-blue-600">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memuat galeri...
                    </div>
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-12 md:mb-16">
                    @foreach ($galleries as $gallery)
                        <div wire:key="gallery-{{ $gallery->id }}" 
                             class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-md hover:shadow-lg transition-all duration-300">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                @if (!empty($gallery->images) && is_array($gallery->images))
                                    <img src="{{ asset('storage/' . $gallery->images[0]) }}"
                                         alt="{{ $gallery->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                @if (!empty($gallery->images) && count($gallery->images) > 1)
                                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-gray-800 px-2 py-1 rounded-full text-xs font-medium shadow-sm transition-all duration-300 group-hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                        {{ count($gallery->images) }} foto
                                    </div>
                                @endif

                                <div class="absolute bottom-0 left-0 right-0 p-4 md:p-6 translate-y-5 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                    <h3 class="text-lg md:text-xl font-bold text-white mb-1 md:mb-2">{{ $gallery->title }}</h3>
                                    @if ($gallery->description)
                                        <p class="text-gray-200 text-xs md:text-sm line-clamp-2">
                                            {{ Str::limit($gallery->description, 80) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a wire:navigate href="{{ route('gallery.show', $gallery->slug) }}"
                                       class="bg-white/90 backdrop-blur-sm text-gray-800 px-4 py-2 md:px-6 md:py-3 rounded-full font-medium hover:bg-white transform scale-95 hover:scale-100 transition-all duration-200 flex items-center text-sm md:text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Gallery
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <a wire:navigate href="{{ route('gallery.index') }}"
                       class="inline-flex items-center px-6 py-2 md:px-8 md:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-full hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300 text-sm md:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Lihat Semua Galeri
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Quote of the Day -->
    @if ($quoteOfTheDay)
        <section class="py-12 md:py-16 bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-white p-6 md:p-8 rounded-xl md:rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 md:h-12 md:w-12 text-blue-400 mx-auto mb-4 md:mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <blockquote class="text-xl md:text-2xl font-medium text-gray-800 italic mb-4 md:mb-6">
                        "{{ $quoteOfTheDay->quote }}"
                    </blockquote>
                    @if ($quoteOfTheDay->author)
                        <footer class="text-base md:text-lg text-gray-600">— {{ $quoteOfTheDay->author }}</footer>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Artikel Section -->
    @if ($featuredArticles->count() > 0)
        <section class="py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <span class="inline-block px-3 py-1 text-xs md:text-sm font-medium text-blue-600 bg-blue-100 rounded-full mb-3 md:mb-4">
                        Artikel Terbaru
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Informasi Terkini
                        </span>
                    </h2>
                    <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                        Temukan artikel menarik dan informatif dari kami
                    </p>
                </div>

                <div wire:loading.delay class="text-center py-8">
                    <div class="inline-flex items-center text-blue-600">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memuat artikel...
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach ($featuredArticles as $article)
                        <article wire:key="article-{{ $article->id }}" 
                                 class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 bg-white">
                            @if ($article->featured_image)
                                <div class="aspect-[4/3] overflow-hidden">
                                    <img src="{{ asset('storage/' . $article->featured_image) }}"
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                            @else
                                <div class="aspect-[4/3] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-4 md:p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full">
                                        {{ $article->category->name }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $article->published_at->format('d M Y') }}
                                    </span>
                                </div>

                                <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                                    <a wire:navigate href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                </h3>

                                @if ($article->excerpt)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ Str::limit($article->excerpt, 100) }}
                                    </p>
                                @endif

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-xs text-gray-500">By {{ $article->author->name }}</p>
                                        </div>
                                    </div>
                                    <a wire:navigate href="{{ route('articles.show', $article) }}"
                                       class="text-blue-600 hover:text-blue-800 text-xs font-medium flex items-center">
                                        Baca Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>  