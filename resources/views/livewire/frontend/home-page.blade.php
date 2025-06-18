<div>
    <div>
        <!-- Hero/Slideshow Section -->
        @if ($banners->count() > 0)
            <section class="relative overflow-hidden m-10 rounded-2xl hover:shadow-xl transition-shadow duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-indigo-600/20 z-10"></div>
                <livewire:components.slideshow />
                <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent z-20"></div>
            </section>
        @endif
    
        <!-- Gallery Section -->
        @if ($galleries->count() > 0)
            <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50/30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <span class="inline-block px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-full mb-4">Moment Terbaik</span>
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">
                            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Galeri Kami</span>
                        </h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Jelajahi momen-momen terbaik yang telah kami abadikan dalam koleksi foto pilihan
                        </p>
                    </div>
    
                    <!-- Gallery Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        @foreach ($galleries as $gallery)
                            <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500">
                                <!-- Gallery Image with Overlay -->
                                <div class="relative h-80 overflow-hidden">
                                    @if (!empty($gallery->images) && is_array($gallery->images))
                                        <img src="{{ asset('storage/' . $gallery->images[0]) }}"
                                            alt="{{ $gallery->title }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
    
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    
                                    <!-- Images Count Badge -->
                                    @if (!empty($gallery->images) && count($gallery->images) > 1)
                                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1 rounded-full text-sm font-medium shadow-sm transition-all duration-300 group-hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                            </svg>
                                            {{ count($gallery->images) }} foto
                                        </div>
                                    @endif
    
                                    <!-- Content Overlay -->
                                    <div class="absolute bottom-0 left-0 right-0 p-6 translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                        <h3 class="text-xl font-bold text-white mb-2">{{ $gallery->title }}</h3>
                                        
                                        @if ($gallery->description)
                                            <p class="text-gray-200 text-sm mb-4 line-clamp-2">
                                                {{ Str::limit($gallery->description, 80) }}
                                            </p>
                                        @endif
                                    </div>
    
                                    <!-- View Button -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('gallery.show', $gallery->slug) }}"
                                            class="bg-white/90 backdrop-blur-sm text-gray-800 px-6 py-3 rounded-full font-semibold hover:bg-white transform scale-95 hover:scale-100 transition-all duration-200 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
    
                    <!-- View All Button -->
                    <div class="text-center">
                        <a href="{{ route('gallery.index') }}"
                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-full hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Lihat Semua Galeri
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif
    
        <!-- Quote of the Day -->
        @if ($quoteOfTheDay)
            <section class="py-16 bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-400 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <blockquote class="text-2xl font-medium text-gray-800 italic mb-6">
                            "{{ $quoteOfTheDay->quote }}"
                        </blockquote>
                        @if ($quoteOfTheDay->author)
                            <footer class="text-lg text-gray-600">— {{ $quoteOfTheDay->author }}</footer>
                        @endif
                    </div>
                </div>
            </section>
        @endif
    
        <!-- Featured Articles -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="inline-block px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-full mb-4">Pengetahuan</span>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Artikel Terbaru</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Temukan wawasan dan pengetahuan terbaru dari jurusan kami
                    </p>
                </div>
    
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    @foreach ($featuredArticles as $article)
                        <article class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            @if ($article->featured_image)
                                <div class="h-56 overflow-hidden">
                                    <img src="{{ asset('storage/' . $article->featured_image) }}"
                                        alt="{{ $article->title }}" 
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                </div>
                            @else
                                <div class="h-56 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                            @endif
    
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full">
                                        {{ $article->category->name }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ $article->published_at->format('d M Y') }}
                                    </span>
                                </div>
    
                                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200">
                                    <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                </h3>
    
                                @if ($article->excerpt)
                                    <p class="text-gray-600 mb-5 line-clamp-2">
                                        {{ Str::limit($article->excerpt, 100) }}
                                    </p>
                                @endif
    
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-500">By {{ $article->author->name }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                        Baca Selengkapnya
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
    
                <div class="text-center">
                    <a href="{{ route('articles.index') }}"
                        class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transform hover:-translate-y-1 transition-all duration-300">
                        Lihat Semua Artikel
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    
        <!-- Custom Styles -->
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
    
            /* Smooth animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
    
            .animate-fade-in {
                animation: fadeInUp 0.6s ease-out forwards;
            }
    
            /* Hover effect for cards */
            .group:hover .group-hover\:translate-y-0 {
                transform: translateY(0);
            }
    
            /* Gradient underline effect */
            .underline-gradient {
                position: relative;
            }
            .underline-gradient::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 2px;
                background: linear-gradient(to right, #3b82f6, #6366f1);
                transition: width 0.3s ease;
            }
            .underline-gradient:hover::after {
                width: 100%;
            }
        </style>
    </div>
</div>