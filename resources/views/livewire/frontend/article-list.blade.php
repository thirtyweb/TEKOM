<div>
    <!-- article-list.blade.php -->
<div>
    @section('title', 'Artikel')
    
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Artikel</h1>
            
            <!-- Filter & Search -->
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="flex-1">
                    <input type="text" wire:model.live="search" placeholder="Cari artikel..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <select wire:model.live="categoryId" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select wire:model.live="sortBy" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="latest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="popular">Terpopuler</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
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
                                <div class="flex items-center text-sm text-gray-500">
                                    <span>By {{ $article->author->name }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $article->views }} views</span>
                                </div>
                                <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Baca</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Tidak ada artikel yang ditemukan.</p>
                    </div>
                @endforelse
            </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</div>
</div>
