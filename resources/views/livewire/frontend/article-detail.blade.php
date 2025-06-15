<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div>
        @section('title', $article->title ?? 'Artikel')
        @section('meta_description', $article->excerpt ?? '')
        
        <div class="container mx-auto px-4 py-8">
            <!-- Breadcrumb Navigation -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a></li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('articles.index') }}" class="hover:text-blue-600">Artikel</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">{{ Str::limit($article->title ?? 'Detail Artikel', 50) }}</span>
                    </li>
                </ol>
            </nav>
    
            <div class="max-w-4xl mx-auto">
                <!-- Article Header -->
                <header class="mb-8">
                    <!-- Category Badge -->
                    <div class="mb-4">
                        <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                            {{ $article->category->name ?? 'Tanpa Kategori' }}
                        </span>
                    </div>
                    
                    <!-- Article Title -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">
                        {{ $article->title ?? 'Judul Artikel' }}
                    </h1>
                    
                    <!-- Excerpt -->
                    @if(!empty($article->excerpt))
                        <p class="text-xl text-gray-600 mb-6 leading-relaxed">
                            {{ $article->excerpt }}
                        </p>
                    @endif
                    
                    <!-- Article Meta -->
                    <div class="flex items-center justify-between py-4 border-t border-b border-gray-200">
                        <div class="flex items-center space-x-4">
                            <!-- Author -->
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $article->author->name ?? 'Penulis Tidak Diketahui' }}</span>
                            </div>
                            
                            <!-- Publish Date -->
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>
                                    @if($article->published_at)
                                        {{ $article->published_at->translatedFormat('d F Y') }}
                                    @else
                                        Belum Dipublikasikan
                                    @endif
                                </span>
                            </div>
                            
                            <!-- Views Count -->
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ number_format($article->views ?? 0) }} dilihat</span>
                            </div>
                            
                            <!-- Reading Time -->
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $article->reading_time ?? 5 }} menit baca</span>
                            </div>
                        </div>
                        
                        <!-- Share Buttons -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500 mr-2">Bagikan:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank" 
                               class="text-blue-600 hover:text-blue-800 p-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title ?? '') }}" 
                               target="_blank" 
                               class="text-blue-400 hover:text-blue-600 p-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode(($article->title ?? 'Artikel') . ' ' . url()->current()) }}" 
                               target="_blank" 
                               class="text-green-600 hover:text-green-800 p-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/></svg>
                            </a>
                        </div>
                    </div>
                </header>
    
                <!-- Featured Image -->
                @if($article->featured_image)
                    <div class="mb-8">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-96 object-cover rounded-lg shadow-lg">
                    </div>
                @endif
    
                <!-- Article Content -->
                <article class="prose prose-lg max-w-none mb-12">
                    {!! $article->content ?? '<p class="text-gray-500">Konten tidak tersedia</p>' !!}
                </article>
    
                <!-- Tags -->
                @if(!empty($article->meta_data['tags']))
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-3">Tag:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($article->meta_data['tags'] as $tag)
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
    
                <!-- Author Bio -->
                <div class="bg-gray-50 rounded-lg p-6 mb-12">
                    <h3 class="text-lg font-semibold mb-3">Tentang Penulis</h3>
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $article->author->name ?? 'Penulis' }}</h4>
                            @if(!empty($article->author->bio))
                                <p class="text-gray-600 mt-1">{{ $article->author->bio }}</p>
                            @endif
                        </div>
                    </div>
                </div>
    
                <!-- Related Articles -->
                @if($relatedArticles->count() > 0)
                    <section class="mb-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedArticles as $related)
                                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                    @if($related->featured_image)
                                        <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                             alt="{{ $related->title }}" 
                                             class="w-full h-48 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <div class="text-sm text-gray-500 mb-2">
                                            {{ $related->published_at?->translatedFormat('d M Y') ?? 'Belum dipublikasikan' }}
                                        </div>
                                        <h4 class="font-semibold mb-2">
                                            <a href="{{ route('articles.show', $related) }}" 
                                               class="text-gray-800 hover:text-blue-600">
                                                {{ $related->title }}
                                            </a>
                                        </h4>
                                        @if($related->excerpt)
                                            <p class="text-gray-600 text-sm">
                                                {{ Str::limit($related->excerpt, 80) }}
                                            </p>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif
    
                <!-- Navigation -->
                <div class="flex justify-between items-center pt-8 border-t border-gray-200">
                    <a href="{{ route('articles.index') }}" 
                       class="flex items-center text-blue-600 hover:text-blue-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Kembali ke Daftar Artikel
                    </a>
                    
                    <div class="text-sm text-gray-500">
                        Terakhir diupdate: {{ $article->updated_at?->translatedFormat('d F Y') ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
