<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div>
        @section('title', $article->title ?? 'Artikel')
        @section('meta_description', $article->excerpt ?? '')

        {{-- [UBAH] Latar belakang diubah agar menyatu dengan tema gelap --}}
        <div class="min-h-screen pt-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Breadcrumb Navigation --}}
                <nav class="mb-8">
                    {{-- [UBAH] Breadcrumbs dengan gaya terminal --}}
                    <ol class="flex items-center space-x-2 font-mono text-sm text-gray-500">
                        <li><a wire:navigate href="{{ route('home') }}" class="hover:text-green-300 transition-colors">/home</a></li>
                        <li><span class="text-gray-600">/</span></li>
                        <li><a wire:navigate href="{{ route('articles.index') }}" class="hover:text-green-300 transition-colors">all articles</a></li>
                        <li><span class="text-gray-600">/</span></li>
                        <li class="text-green-400 truncate">{{ $article->slug ?? 'reading_log' }}</li>
                    </ol>
                </nav>

                <div class="w-full">
                    {{-- Article Header --}}
                    <header class="mb-8">
                        {{-- Category Badge --}}
                        <div class="mb-4">
                            {{-- [UBAH] Badge dengan gaya 'chip' digital --}}
                            <span class="font-mono text-xs text-green-300 bg-green-900/50 border border-green-800 px-3 py-1 rounded-full">
                                TOPIC: {{ $article->category->name ?? 'UNCATEGORIZED' }}
                            </span>
                        </div>

                        {{-- Article Title --}}
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-green-300 mb-6 leading-tight drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]">
                            {{ $article->title ?? 'Title Not Found' }}
                        </h1>

                        {{-- Excerpt --}}
                        @if(!empty($article->excerpt))
                            <p class="text-xl text-gray-400 mb-6 leading-relaxed italic border-l-4 border-green-500/30 pl-4">
                                {{ $article->excerpt }}
                            </p>
                        @endif

                        {{-- Article Meta --}}
                        {{-- [UBAH] Meta info dengan gaya data log --}}
                        <div class="flex flex-wrap items-center gap-x-6 gap-y-2 py-4 border-t border-b border-gray-800 font-mono text-xs text-gray-500">
                            <div class="flex items-center" title="Author">
                                <i class="fas fa-user-secret mr-2 text-green-400/70"></i>
                                <span>SOURCE: {{ $article->author->name ?? 'UNKNOWN' }}</span>
                            </div>
                            <div class="flex items-center" title="Published Date">
                                <i class="fas fa-calendar-day mr-2 text-green-400/70"></i>
                                <span>DATE: {{ $article->published_at ? $article->published_at->format('Y-m-d') : 'N/A' }}</span>
                            </div>
                            <div class="flex items-center" title="Views">
                                <i class="fas fa-eye mr-2 text-green-400/70"></i>
                                <span>{{ number_format($article->views ?? 0) }} VIEWS</span>
                            </div>
                            <div class="flex items-center" title="Reading Time">
                                <i class="fas fa-clock mr-2 text-green-400/70"></i>
                                <span>~{{ $article->reading_time ?? 5 }} MIN READ</span>
                            </div>
                        </div>
                    </header>

                    {{-- Featured Image --}}
                    @if($article->featured_image)
                        <div class="mb-8 border-2 border-green-500/20 shadow-[0_0_20px_rgba(52,211,153,0.1)] p-1">
                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-auto object-cover opacity-80">
                        </div>
                    @endif

                    {{-- Article Content --}}
                    {{-- [UBAH] Konten diubah dengan style 'prose-invert' dan warna hijau --}}
                    <article class="prose prose-lg prose-invert max-w-none mb-12 prose-headings:text-green-300 prose-a:text-green-400 prose-blockquote:border-green-500 prose-strong:text-white">
                        {!! $article->content ?? '<p class="text-gray-500">// CONTENT_STREAM_EMPTY //</p>' !!}
                    </article>

                    {{-- Tags --}}
                    @if(!empty($article->meta_data['tags']) && is_array($article->meta_data['tags']))
                    <div class="mb-12">
                        <h3 class="font-mono text-lg font-semibold mb-3 text-green-300">// Relevant Keywords</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($article->meta_data['tags'] as $tag)
                                <span class="font-mono text-xs text-gray-300 bg-gray-800 px-3 py-1 rounded-full border border-gray-700">
                                    #{{ is_array($tag) ? $tag['name'] : $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Author Bio --}}
                    <div class="bg-gray-900/40 border border-gray-800 rounded-lg p-6 mb-12">
                        <h3 class="font-mono text-lg font-semibold mb-4 text-green-300">// About The Author</h3>
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gray-800 border-2 border-gray-700 rounded-full flex-shrink-0 overflow-hidden">
                                @if($article->author->avatar)
                                    <img src="{{ asset('storage/' . $article->author->avatar) }}"
                                         alt="Avatar {{ $article->author->name ?? 'Unknown Agent' }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-700 flex items-center justify-center">
                                        <i class="fas fa-user-astronaut text-3xl text-gray-500"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-semibold text-white text-lg">{{ $article->author->name ?? 'Unknown Agent' }}</h4>
                                @if(!empty($article->author->bio))
                                    <p class="text-gray-400 mt-1">{{ $article->author->bio }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Related Articles --}}
                    @if($relatedArticles->count() > 0)
                        <section class="mb-12">
                            <h3 class="font-mono text-2xl font-bold text-green-300 mb-6">&gt; Related Articles</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($relatedArticles as $related)
                                    {{-- [UBAH] Menggunakan desain kartu yang konsisten --}}
                                    <article wire:key="related-article-{{ $related->id }}"
                                             class="group flex flex-col bg-gray-900/40 border border-gray-800 rounded-lg overflow-hidden hover:border-green-500/50 transition-colors duration-300">
                                        @if($related->featured_image)
                                            <div class="aspect-[16/9] overflow-hidden">
                                                <a wire:navigate href="{{ route('articles.show', $related) }}">
                                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover transition-all duration-500 opacity-40 group-hover:opacity-70">
                                                </a>
                                            </div>
                                        @endif
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h4 class="font-semibold mb-2 flex-grow group-hover:text-green-300 transition-colors">
                                                <a wire:navigate href="{{ route('articles.show', $related) }}">{{ $related->title }}</a>
                                            </h4>
                                            <div class="text-xs text-gray-500 mt-auto pt-2 border-t border-gray-800">
                                                {{ $related->published_at?->format('Y-m-d') ?? '' }}
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- Navigation --}}
                    <div class="flex justify-between items-center pt-8 border-t border-gray-800">
                        <a wire:navigate href="{{ route('articles.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-gray-800 text-green-300 border-2 border-green-400/50 font-bold rounded-lg hover:bg-green-400/10 hover:text-green-200 hover:border-green-400 transition-all duration-300 text-sm">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Artikel
                        </a>

                        {{-- Share Buttons --}}
                        <div class="flex items-center space-x-2">
                             <a wire:navigate href="..." target="_blank" class="text-gray-500 hover:text-green-400 p-2 transition-colors"><i class="fab fa-facebook-f"></i></a>
                             <a wire:navigate href="..." target="_blank" class="text-gray-500 hover:text-green-400 p-2 transition-colors"><i class="fab fa-twitter"></i></a>
                             <a wire:navigate href="..." target="_blank" class="text-gray-500 hover:text-green-400 p-2 transition-colors"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .perspective-1000 {
                perspective: 1000px;
            }
            .-rotate-x-1 {
                transform: rotateX(-1deg);
            }

            ::-webkit-scrollbar {
                width: 1px;
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
    </style>
</div>