<!-- 
    File ini bisa Anda gunakan untuk menggantikan komponen slideshow Anda.
    Semua fungsionalitas Livewire dan Alpine.js tetap sama, hanya kelas CSS yang diubah.
-->
<div class="relative w-full h-[75vh] max-h-[700px] min-h-[450px] overflow-hidden bg-black p-2 md:p-3 border-2 border-green-500/20"
     x-data="{
         currentSlide: 0,
         slidesCount: {{ count($allSlides) }},
         touchStartX: 0,
         touchEndX: 0,
         direction: 1,
         init() {
             if (this.slidesCount > 1) {
                 setInterval(() => {
                     this.direction = 1;
                     this.nextSlide();
                 }, 7000);
             }
         },
         nextSlide() {
             this.direction = 1;
             this.currentSlide = (this.currentSlide + 1) % this.slidesCount;
             $wire.goToSlide(this.currentSlide);
         },
         prevSlide() {
             this.direction = -1;
             this.currentSlide = (this.currentSlide - 1 + this.slidesCount) % this.slidesCount;
             $wire.goToSlide(this.currentSlide);
         },
         handleTouchStart(e) { this.touchStartX = e.changedTouches[0].screenX; },
         handleTouchEnd(e) { this.touchEndX = e.changedTouches[0].screenX; this.handleSwipe(); },
         handleSwipe() {
             const diff = this.touchStartX - this.touchEndX;
             if (diff > 50) { this.nextSlide(); } else if (diff < -50) { this.prevSlide(); }
         }
     }"
     @touchstart="handleTouchStart"
     @touchend="handleTouchEnd">

    <!-- [UBAH] Elemen-elemen dekoratif untuk Frame HUD -->
    <div class="absolute top-2 left-2 w-8 h-8 border-t-2 border-l-2 border-green-400/50 z-20"></div>
    <div class="absolute top-2 right-2 w-8 h-8 border-t-2 border-r-2 border-green-400/50 z-20"></div>
    <div class="absolute bottom-2 left-2 w-8 h-8 border-b-2 border-l-2 border-green-400/50 z-20"></div>
    <div class="absolute bottom-2 right-2 w-8 h-8 border-b-2 border-r-2 border-green-400/50 z-20"></div>
    <div class="absolute top-0 left-0 w-full p-3 font-mono text-xs text-green-400/50 z-20">[ TEKOMSS Mainframe // Status: Secure ]</div>

    @if(count($allSlides) > 0)
        <!-- Slides Container -->
        <div class="relative w-full h-full">
            @foreach($allSlides as $index => $slide)
                <!-- [UBAH] Transisi diubah menjadi cross-fade yang lebih digital -->
                <div x-show="currentSlide === {{ $index }}" 
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-1000"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0">
                    
                    <!-- Background Image -->
                    @if($slide['image_url'])
                        <div class="absolute inset-0 overflow-hidden">
                            <!-- [UBAH] Gambar diberi efek tint hijau dan filter agar menyatu -->
                            <img src="{{ $slide['image_url'] }}" 
                                 alt="{{ $slide['title'] ?? 'Banner slide' }}"
                                 class="w-full h-full object-cover scale-105 filter saturate-0 contrast-125">
                        </div>
                    @else
                        <!-- Fallback Background -->
                        <div class="w-full h-full bg-black"></div>
                    @endif

                    <!-- [UBAH] Overlay diubah menjadi kombinasi gradien dan pola scanline -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-black/30"></div>
                    <div class="absolute inset-0 opacity-20" style="background: repeating-linear-gradient(0deg, rgba(0, 255, 0, 0.3), rgba(0, 255, 0, 0.3) 1px, transparent 1px, transparent 3px);"></div>

                    <!-- Content -->
                    <!-- [UBAH] Layout konten diubah menjadi di kiri bawah untuk gaya HUD -->
                    <div class="absolute inset-0 flex items-end justify-start p-6 md:p-10">
                        <div class="text-white max-w-2xl transform transition-all duration-1000 ease-out"
                             x-show="currentSlide === {{ $index }}"
                             x-transition:enter="transition ease-out duration-1000"
                             x-transition:enter-start="opacity-0 translate-y-5"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-500"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0">
                            
                            {{-- @if($slide['title'])
                                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 font-mono text-green-300 drop-shadow-[0_0_10px_rgba(52,211,153,0.5)]">
                                    {{ $slide['title'] }}
                                </h1>
                            @endif --}}

                            @if($slide['description'])
                                <p class="text-lg md:text-xl mb-8 opacity-80 max-w-xl">
                                    {{ $slide['description'] }}
                                </p>
                            @endif

                            @if($slide['link_url'])
                                <div>
                                    <!-- [UBAH] Tombol didesain ulang menjadi tombol perintah -->
                                    <a href="{{ $slide['link_url'] }}" 
                                       class="inline-flex items-center bg-green-500 text-black font-bold py-3 px-8 rounded-none hover:bg-green-400 transition-colors duration-300 group">
                                        {{ $slide['button_text'] ?? 'EXECUTE' }}
                                        <span class="font-mono text-lg ml-3 transition-transform duration-300 group-hover:translate-x-1">&gt;</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- [UBAH] Progress Indicator didesain ulang -->
        @if(count($allSlides) > 1)
            <div class="absolute bottom-4 right-4 flex flex-col space-y-2 z-20">
                @foreach($allSlides as $index => $slide)
                    <button @click="currentSlide = {{ $index }}; $wire.goToSlide({{ $index }});" 
                            class="w-6 h-1 rounded-sm transition-colors duration-300"
                            :class="{
                                'bg-green-400': currentSlide === {{ $index }},
                                'bg-green-400/30 hover:bg-green-400/60': currentSlide !== {{ $index }}
                            }">
                    </button>
                @endforeach
            </div>
        @endif

    @else
        <!-- Fallback disesuaikan dengan tema baru -->
        <div class="w-full h-full bg-black flex items-center justify-center">
            <div class="text-center text-green-300 font-mono animate-pulse">
                <h2 class="text-4xl font-bold mb-4">[ NO SIGNAL ]</h2>
                <p class="text-lg opacity-70">Awaiting data stream...</p>
            </div>
        </div>
    @endif
</div>
