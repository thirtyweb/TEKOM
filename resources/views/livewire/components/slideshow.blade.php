<div class="relative w-full h-[80vh] max-h-[800px] min-h-[500px] overflow-hidden"
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
         handleTouchStart(e) {
             this.touchStartX = e.changedTouches[0].screenX;
         },
         handleTouchEnd(e) {
             this.touchEndX = e.changedTouches[0].screenX;
             this.handleSwipe();
         },
         handleSwipe() {
             const diff = this.touchStartX - this.touchEndX;
             if (diff > 50) {
                 this.nextSlide();
             } else if (diff < -50) {
                 this.prevSlide();
             }
         }
     }"
     @touchstart="handleTouchStart"
     @touchend="handleTouchEnd">

    @if(count($allSlides) > 0)
        <!-- Slides Container -->
        <div class="relative w-full h-full">
            @foreach($allSlides as $index => $slide)
                <div x-show="currentSlide === {{ $index }}" 
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 transform"
                     x-transition:enter-end="opacity-100 transform"
                     x-transition:leave="transition ease-in duration-1000"
                     x-transition:leave-start="opacity-100 transform"
                     x-transition:leave-end="opacity-0 transform"
                     :class="{
                         'translate-x-0': currentSlide === {{ $index }},
                         'translate-x-full': direction === 1 && currentSlide !== {{ $index }},
                         '-translate-x-full': direction === -1 && currentSlide !== {{ $index }}
                     }"
                     class="absolute inset-0">
                    
                    <!-- Background Image with Parallax Effect -->
                    @if($slide['image_url'])
                        <div class="absolute inset-0 overflow-hidden">
                            <img src="{{ $slide['image_url'] }}" 
                                 alt="{{ $slide['title'] ?? 'Banner slide' }}"
                                 class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-transform duration-10000">
                        </div>
                    @else
                        <!-- Gradient Fallback Background -->
                        <div class="w-full h-full bg-gradient-to-br from-indigo-900 via-purple-800 to-pink-700"></div>
                    @endif

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-black/10"></div>

                    <!-- Content -->
                    <div class="absolute inset-0 flex items-center justify-center px-6">
                        <div class="text-center text-white max-w-4xl transform transition-all duration-1000 ease-[cubic-bezier(0.33,1,0.68,1)]"
                             x-bind:class="{
                                 'translate-y-0 opacity-100': currentSlide === {{ $index }},
                                 'translate-y-10 opacity-0': currentSlide !== {{ $index }}
                             }">
                            @if($slide['title'])
                                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 drop-shadow-2xl gradient-text animate-fade-in-up">
                                    {{ $slide['title'] }}
                                </h1>
                            @endif

                            @if($slide['description'])
                                <p class="text-xl md:text-2xl lg:text-3xl mb-10 opacity-90 drop-shadow-lg max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
                                    {{ $slide['description'] }}
                                </p>
                            @endif

                            @if($slide['link_url'])
                                <div class="animate-fade-in-up" style="animation-delay: 0.4s">
                                    <a href="{{ $slide['link_url'] }}" 
                                       class="inline-flex items-center glass-effect hover-lift text-white font-semibold py-4 px-10 rounded-xl transition-all duration-300 hover:bg-white/30 border border-white/20">
                                        {{ $slide['button_text'] ?? 'Learn More' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-3 -mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <!-- Navigation Buttons -->
        @if(count($allSlides) > 1)
            <div class="absolute inset-0 flex items-center justify-between px-4 pointer-events-none">
                <!-- Previous Button -->
                <button @click="prevSlide" 
                        class="pointer-events-auto glass-effect hover-lift text-white p-4 rounded-full transition-all duration-300 hover:bg-white/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Next Button -->
                <button @click="nextSlide" 
                        class="pointer-events-auto glass-effect hover-lift text-white p-4 rounded-full transition-all duration-300 hover:bg-white/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        @endif --}}

        <!-- Progress Indicator -->
        @if(count($allSlides) > 1)
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2">
                @foreach($allSlides as $index => $slide)
                    <button @click="currentSlide = {{ $index }}; $wire.goToSlide({{ $index }}); direction = currentSlide > {{ $index }} ? -1 : 1;" 
                            class="h-1.5 rounded-full transition-all duration-500 overflow-hidden"
                            :class="{
                                'bg-white/90 w-8': currentSlide === {{ $index }},
                                'bg-white/30 hover:bg-white/50 w-4': currentSlide !== {{ $index }}
                            }">
                        <div x-show="currentSlide === {{ $index }}" 
                             x-transition:enter="transition-all ease-linear duration-7000"
                             x-transition:enter-start="width: 0%"
                             x-transition:enter-end="width: 100%"
                             class="h-full bg-white origin-left"
                             style="display: none;"></div>
                    </button>
                @endforeach
            </div>
        @endif

    @else
        <!-- Fallback when no banners -->
        <div class="w-full h-full bg-gradient-to-br from-indigo-900 via-purple-800 to-pink-700 flex items-center justify-center">
            <div class="text-center text-white animate-fade-in-up">
                <h2 class="text-5xl font-bold mb-6 gradient-text">Welcome to Our Website</h2>
                <p class="text-xl opacity-90 mb-8">No banners available</p>
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center glass-effect hover-lift text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300">
                    Explore Website
                </a>
            </div>
        </div>
    @endif
</div>

