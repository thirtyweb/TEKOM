<div class="relative w-full h-96 md:h-[500px] lg:h-[600px] overflow-hidden rounded-lg shadow-lg">

    @if(count($allSlides) > 0)
        <!-- Slides Container -->
        <div class="relative w-full h-full">
            @foreach($allSlides as $index => $slide)
                <div class="absolute inset-0 transition-opacity duration-500 ease-in-out {{ $currentSlide === $index ? 'opacity-100' : 'opacity-0' }}">
                    
                    <!-- Background Image -->
                    @if($slide['image_url'])
                        <img src="{{ $slide['image_url'] }}" 
                             alt="{{ $slide['title'] ?? 'Banner slide' }}"
                             class="w-full h-full object-cover">
                    @else
                        <!-- Fallback background jika tidak ada gambar -->
                        <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600"></div>
                    @endif

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

                    <!-- Content -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center text-white px-4 max-w-4xl">
                            @if($slide['title'])
                                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4">
                                    {{ $slide['title'] }}
                                </h1>
                            @endif

                            @if($slide['description'])
                                <p class="text-lg md:text-xl lg:text-2xl mb-8 opacity-90">
                                    {{ $slide['description'] }}
                                </p>
                            @endif

                            @if($slide['link_url'])
                                <a href="{{ $slide['link_url'] }}" 
                                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                                    {{ $slide['button_text'] ?? 'Learn More' }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Buttons -->
        @if(count($allSlides) > 1)
            <!-- Previous Button -->
            <button wire:click="prevSlide" 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-40 text-white p-3 rounded-full transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <!-- Next Button -->
            <button wire:click="nextSlide" 
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-40 text-white p-3 rounded-full transition duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

        <!-- Dots Indicator -->
        @if(count($allSlides) > 1)
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                @foreach($allSlides as $index => $slide)
                    <button wire:click="goToSlide({{ $index }})" 
                            class="w-3 h-3 rounded-full transition duration-300 {{ $currentSlide === $index ? 'bg-white' : 'bg-white bg-opacity-50 hover:bg-opacity-75' }}">
                    </button>
                @endforeach
            </div>
        @endif

        <!-- Debug Info (hapus setelah testing) -->
        <div class="absolute top-4 left-4 bg-black bg-opacity-50 text-white text-sm p-2 rounded">
            Slide {{ $currentSlide + 1 }} of {{ count($allSlides) }}
        </div>

    @else
        <!-- Fallback when no banners -->
        <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Welcome to Our Website</h2>
                <p class="text-xl opacity-90">No banners available</p>
            </div>
        </div>
    @endif
</div>