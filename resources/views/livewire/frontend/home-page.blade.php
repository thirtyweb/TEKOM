<div>
    <div>
        <!-- Hero/Slideshow Section -->
        @if ($banners->count() > 0)
            <section class="relative m-10">
                <livewire:components.slideshow />
            </section>
        @endif

        <!-- Gallery Section -->
        @if ($galleries->count() > 0)
            <section class="py-16 bg-gradient-to-br from-gray-50 to-blue-50">
                <div class="container mx-auto px-4">
                    <!-- Section Header -->
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-camera text-blue-600 mr-3"></i>
                            Galeri Terbaru
                        </h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Jelajahi momen-momen terbaik yang telah kami abadikan dalam koleksi foto pilihan
                        </p>
                    </div>

                    <!-- Gallery Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @foreach ($galleries as $gallery)
                            <div
                                class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500">
                                <!-- Gallery Image with Overlay -->
                                <div class="relative h-64 overflow-hidden">
                                    @if (!empty($gallery->images) && is_array($gallery->images))
                                        <img src="{{ asset('storage/' . $gallery->images[0]) }}"
                                            alt="{{ $gallery->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 text-5xl"></i>
                                        </div>
                                    @endif

                                    <!-- Gradient Overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>

                                    <!-- Images Count Badge -->
                                    @if (!empty($gallery->images) && count($gallery->images) > 1)
                                        <div
                                            class="absolute top-4 right-4 bg-black/70 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-images mr-1"></i>
                                            {{ count($gallery->images) }} foto
                                        </div>
                                    @endif

                                    <!-- View Button Overlay -->
                                    <div
                                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <a href="{{ route('gallery.show', $gallery->slug) }}"
                                            class="bg-white/90 backdrop-blur-sm text-gray-800 px-6 py-3 rounded-full font-semibold hover:bg-white transform scale-95 hover:scale-100 transition-all duration-200">
                                            <i class="fas fa-eye mr-2"></i>
                                            Lihat Gallery
                                        </a>
                                    </div>
                                </div>

                                <!-- Gallery Content -->
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                                        {{ $gallery->title }}
                                    </h3>

                                    @if ($gallery->description)
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                            {{ Str::limit($gallery->description, 80) }}
                                        </p>
                                    @endif

                                    <!-- Gallery Meta Info -->
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <span class="flex items-center">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ $gallery->created_at->format('d M Y') }}
                                        </span>
                                        @if (!empty($gallery->images))
                                            <span
                                                class="flex items-center bg-blue-50 text-blue-600 px-2 py-1 rounded-full">
                                                <i class="fas fa-images mr-1"></i>
                                                {{ count($gallery->images) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- View All Button -->
                    <div class="text-center">
                        <a href="{{ route('gallery.index') }}"
                            class="inline-flex items-center bg-blue-600 text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                            <i class="fas fa-images mr-3"></i>
                            Lihat Semua Galeri
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- Quote of the Day -->
        @if ($quoteOfTheDay)
            <section class="bg-blue-50 py-12">
                <div class="container mx-auto px-4 text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Quote of the Day</h2>
                    <blockquote class="text-lg italic text-gray-600 max-w-2xl mx-auto">
                        "{{ $quoteOfTheDay->quote }}"
                        @if ($quoteOfTheDay->author)
                            <footer class="mt-4 text-gray-500">— {{ $quoteOfTheDay->author }}</footer>
                        @endif
                    </blockquote>
                </div>
            </section>
        @endif

        <!-- Featured Articles -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Artikel Terbaru</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featuredArticles as $article)
                        <article
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            @if ($article->featured_image)
                                <img src="{{ asset('storage/' . $article->featured_image) }}"
                                    alt="{{ $article->title }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $article->category->name }}</span>
                                    <span
                                        class="text-gray-500 text-sm ml-auto">{{ $article->published_at->format('d M Y') }}</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">
                                    <a href="{{ route('articles.show', $article) }}"
                                        class="text-gray-800 hover:text-blue-600">{{ $article->title }}</a>
                                </h3>
                                @if ($article->excerpt)
                                    <p class="text-gray-600 mb-4">{{ Str::limit($article->excerpt, 100) }}</p>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">By {{ $article->author->name }}</span>
                                    <a href="{{ route('articles.show', $article) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('articles.index') }}"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Lihat Semua Artikel</a>
                </div>
            </div>
        </section>
    </div>

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
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .group:hover .animate-fade-in {
            animation: fadeInUp 0.3s ease-out;
        }
    </style>
</div>
