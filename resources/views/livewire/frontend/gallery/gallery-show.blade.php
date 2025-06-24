    <!-- 
        File ini bisa Anda gunakan untuk menggantikan konten halaman detail galeri Anda.
        Semua fungsionalitas Livewire dan Blade tetap sama, hanya kelas CSS yang diubah.
    -->
    <div>
        <!-- [UBAH] Latar belakang diubah agar menyatu dengan tema gelap -->
        <div class="min-h-screen pt-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="mb-8 md:mb-12">
                    <!-- [UBAH] Breadcrumbs dengan gaya terminal -->
                    <nav class="font-mono text-sm text-gray-500 mb-4">
                        <a wire:navigate href="{{ route('home') }}" class="hover:text-green-300 transition-colors">/home</a>
                        <span class="text-gray-600">/</span>
                        <a wire:navigate href="{{ route('gallery.index') }}" class="hover:text-green-300 transition-colors">visual_archives</a>
                        <span class="text-gray-600">/</span>
                        <span class="text-green-400">{{ $gallery->slug }}</span>
                    </nav>
                    
                    <div class="md:flex items-start justify-between">
                        <div>
                            <!-- [UBAH] Judul menggunakan font-mono dan warna neon -->
                            <h1 class="text-3xl md:text-4xl font-bold text-green-300 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)] mb-2">
                                {{ $gallery->title }}
                            </h1>
                            @if($gallery->description)
                                <p class="text-lg text-gray-400 max-w-3xl">{{ $gallery->description }}</p>
                            @endif
                        </div>
                        <!-- [UBAH] Info diubah menjadi panel data kecil -->
                        <div class="text-right mt-4 md:mt-0 font-mono text-xs text-gray-400 border border-gray-800 bg-gray-900/40 p-3 rounded-md">
                            <p>UPLOAD_DATE: {{ $gallery->created_at->format('Y-m-d') }}</p>
                            <p class="mt-1">IMAGE_COUNT: {{ count($gallery->images) }}</p>
                        </div>
                    </div>
                </div>
        
                <!-- Gallery Grid -->
                @if(!empty($gallery->images) && count($gallery->images) > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-8">
                        @foreach($gallery->images as $index => $image)
                            <!-- [UBAH] Kartu thumbnail dengan gaya HUD -->
                            <div class="group relative aspect-square overflow-hidden rounded-md border border-green-500/20 bg-gray-900/40 p-1 transition-all duration-300 hover:border-green-500/60 cursor-pointer"
                                wire:click="openModal({{ $index }})">
                                <img src="{{ asset('storage/' . $image) }}" 
                                    alt="{{ $gallery->title }} - Image {{ $index + 1 }}"
                                    class="w-full h-full object-cover transition-all duration-500  group-hover:scale-105">
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-search-plus text-white text-2xl"></i>
                                    </div>
                                </div>
                                
                                <!-- Image Number -->
                                <div class="absolute top-2 left-2 bg-black/70 text-green-300 px-2 py-0.5 rounded text-xs font-mono">
                                    #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <i class="fas fa-database text-gray-700 text-6xl mb-4"></i>
                        <h3 class="text-xl font-mono text-gray-400 mb-2">// NO_IMAGE_DATA_IN_ARCHIVE</h3>
                        <p class="text-gray-500">Tidak ada gambar dalam arsip ini.</p>
                    </div>
                @endif
        
                <!-- Back Button -->
                <div class="text-center mt-12">
                    <a wire:navigate href="{{ route('gallery.index') }}" 
                    class="inline-flex items-center px-6 py-3 bg-gray-800 text-green-300 border-2 border-green-400/50 font-bold rounded-lg hover:bg-green-400/10 hover:text-green-200 hover:border-green-400 transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        RETURN_TO_ARCHIVES
                    </a>
                </div>
            </div>
        
            <!-- Modal Lightbox -->
            @if($showModal && !empty($gallery->images))
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-95"
                    x-data="{}" @keydown.escape.window="$wire.closeModal()">
                    
                    <!-- [UBAH] Konten Modal dengan Frame HUD -->
                    <div class="relative w-full h-full flex flex-col p-4 md:p-8" @click.self="$wire.closeModal()">
                        <!-- Header Modal -->
                        <div class="flex-shrink-0 flex items-center justify-between mb-4 text-white font-mono">
                            <div class="text-lg">[ VIEWING ARCHIVE: {{ $currentImageIndex + 1 }} / {{ count($gallery->images) }} ]</div>
                            <button wire:click="closeModal" class="text-gray-400 hover:text-white text-2xl transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <!-- Main Image & Nav Arrows -->
                        <div class="relative flex-grow flex items-center justify-center min-h-0">
                            <img src="{{ asset('storage/' . $gallery->images[$currentImageIndex]) }}" 
                                alt="{{ $gallery->title }}"
                                class="max-w-full max-h-full object-contain mx-auto rounded-md border-2 border-green-500/20 shadow-[0_0_40px_rgba(52,211,153,0.15)]">
                            
                            @if(count($gallery->images) > 1)
                                <button wire:click="previousImage" 
                                        class="absolute left-0 md:left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/80 text-white p-3 rounded-full transition-all duration-200 border border-white/20">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button wire:click="nextImage" 
                                        class="absolute right-0 md:right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/80 text-white p-3 rounded-full transition-all duration-200 border border-white/20">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            @endif
                        </div>
        
                        <!-- Thumbnail Navigation -->
                        @if(count($gallery->images) > 1)
                            <div class="flex-shrink-0 mt-4 max-w-full">
                                <div class="flex justify-center space-x-2 w-full overflow-x-auto pb-2 scrollbar-thin">
                                    @foreach($gallery->images as $index => $image)
                                        <button wire:click="goToImage({{ $index }})" 
                                                class="flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded-md overflow-hidden border-2 transition-all duration-200 
                                                    {{ $index === $currentImageIndex ? 'border-green-400 scale-110' : 'border-transparent opacity-50 hover:opacity-100' }}">
                                            <img src="{{ asset('storage/' . $image) }}" 
                                                alt="Thumbnail {{ $index + 1 }}"
                                                class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        
        <!-- [UBAH] Styles untuk custom scrollbar di tema gelap -->
        <style>
            .scrollbar-thin::-webkit-scrollbar {
                height: 6px;
            }
            .scrollbar-thin::-webkit-scrollbar-track {
                background: rgba(0, 255, 0, 0.05);
                border-radius: 3px;
            }
            .scrollbar-thin::-webkit-scrollbar-thumb {
                background: rgba(0, 255, 0, 0.2);
                border-radius: 3px;
            }
            .scrollbar-thin::-webkit-scrollbar-thumb:hover {
                background: rgba(0, 255, 0, 0.4);
            }
        </style>
    </div>
