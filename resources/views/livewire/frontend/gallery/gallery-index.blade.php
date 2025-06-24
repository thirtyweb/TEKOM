<!-- 
    File ini bisa Anda gunakan untuk menggantikan konten halaman Galeri Anda.
    Semua fungsionalitas Livewire dan Blade tetap sama, hanya kelas CSS yang diubah.
-->
<div>
    <!-- [UBAH] Latar belakang diubah agar menyatu dengan tema gelap -->
    <div class="min-h-screen pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12 md:mb-16">
                <!-- [UBAH] Judul menggunakan font-mono dan warna neon -->
                <h1 class="font-mono text-4xl font-bold text-green-300 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]">
                    &gt; VISUAL_ARCHIVES
                </h1>
                <p class="text-lg text-gray-500 max-w-2xl mx-auto mt-2">
                    Menelusuri arsip visual terenkripsi dari berbagai event dan dokumentasi.
                </p>
            </div>
    
            <!-- Gallery Grid -->
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($galleries as $gallery)
                        <!-- [UBAH] Kartu galeri dengan desain panel HUD dan efek hover neon -->
                        <div class="group relative overflow-hidden rounded-md border border-green-500/30 bg-gray-900/40 p-1 transition-all duration-300 hover:border-green-500/80 hover:shadow-[0_0_25px_rgba(52,211,153,0.25)]">
                            <!-- Gallery Image -->
                            <div class="relative h-64 overflow-hidden">
                                @if(!empty($gallery->images) && is_array($gallery->images))
                                    <img src="{{ asset('storage/' . $gallery->images[0]) }}" 
                                         alt="{{ $gallery->title }}"
                                         class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 filter grayscale group-hover:grayscale-0">
                                @else
                                    <div class="w-full h-full bg-black flex items-center justify-center">
                                        <i class="fas fa-satellite-dish text-5xl text-gray-800"></i>
                                    </div>
                                @endif
                                
                                <!-- Overlay dan Badge -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                                @if(count($gallery->images) > 1)
                                    <div class="absolute top-3 right-3 bg-black/70 text-green-300 px-2 py-1 rounded-md text-xs font-mono border border-green-800">
                                        +{{ count($gallery->images) - 1 }} IMAGES
                                    </div>
                                @endif
                            </div>
    
                            <!-- Gallery Content -->
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-gray-200 mb-2 line-clamp-2 group-hover:text-green-300 transition-colors duration-200">
                                    {{ $gallery->title }}
                                </h3>
                                
                                @if($gallery->description)
                                    <p class="text-gray-400 text-sm mb-4 line-clamp-3">
                                        {{ $gallery->description }}
                                    </p>
                                @endif
    
                                <!-- Gallery Info -->
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-4 font-mono border-t border-gray-800 pt-3">
                                    <span><i class="far fa-calendar mr-1"></i> DATE: {{ $gallery->created_at->format('Y-m-d') }}</span>
                                </div>
    
                                <!-- Action Button -->
                                <a href="{{ route('gallery.show', $gallery->slug) }}" 
                                   class="inline-flex items-center justify-center w-full px-4 py-2 bg-green-900/50 text-green-300 border border-green-700 text-sm font-semibold rounded-md hover:bg-green-800/50 hover:text-white transition-colors duration-200">
                                    <i class="fas fa-folder-open mr-2"></i>
                                    ACCESS_ARCHIVE
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
    
                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $galleries->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-database text-gray-700 text-6xl mb-4"></i>
                        <h3 class="text-xl font-mono text-gray-400 mb-2">
                            // NO_VISUAL_DATA_FOUND
                        </h3>
                        <p class="text-gray-500 mb-6">
                            Arsip visual tidak ditemukan atau gagal didekripsi.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    
        <!-- [HAPUS] Custom Styles dipindahkan ke file CSS utama atau diabaikan karena sudah di-handle oleh Tailwind -->
    </div>
</div>
