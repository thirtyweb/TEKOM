<div>
<div>
    <!-- Hero/Slideshow Section -->
    @if($banners->count() > 0)
        <section class="relative">
            <livewire:components.slideshow />
        </section>
    @endif
    
    <!-- Quote of the Day -->
    @if($quoteOfTheDay)
        <section class="bg-blue-50 py-12">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Quote of the Day</h2>
                <blockquote class="text-lg italic text-gray-600 max-w-2xl mx-auto">
                    "{{ $quoteOfTheDay->quote }}"
                    @if($quoteOfTheDay->author)
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
                @foreach($featuredArticles as $article)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $article->category->name }}</span>
                                <span class="text-gray-500 text-sm ml-auto">{{ $article->published_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">
                                <a href="{{ route('articles.show', $article) }}" class="text-gray-800 hover:text-blue-600">{{ $article->title }}</a>
                            </h3>
                            @if($article->excerpt)
                                <p class="text-gray-600 mb-4">{{ Str::limit($article->excerpt, 100) }}</p>
                            @endif
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">By {{ $article->author->name }}</span>
                                <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('articles.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Lihat Semua Artikel</a>
            </div>
        </div>
    </section>
</div>
</div>
