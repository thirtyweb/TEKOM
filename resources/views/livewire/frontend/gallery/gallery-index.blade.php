<div>
    <div>
        <div class="min-h-screen pt-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16"
                     data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-out-back">
                    <h1 class="font-mono text-4xl md:text-5xl font-bold text-green-300 drop-shadow-[0_0_12px_rgba(52,211,153,0.7)] relative inline-block">
                        &gt; VISUAL_ARCHIVES
                        <span class="absolute left-1/2 transform -translate-x-1/2 bottom-0 w-24 h-1 bg-green-500 rounded-full opacity-70 animate-shine"></span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto mt-4 leading-relaxed">
                        Menelusuri arsip visual terenkripsi dari berbagai event dan dokumentasi digital.
                    </p>
                </div>
        
                @if($galleries->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @foreach($galleries as $index => $gallery)
                            <div class="group relative overflow-hidden rounded-md border border-green-500/30 bg-gray-900/40 p-1 transition-all duration-300 hover:border-green-500/80 hover:shadow-[0_0_35px_rgba(52,211,153,0.4)] transform hover:-translate-y-1"
                                 data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $index * 100 }}" data-aos-easing="ease-out-quad">
                                
                                <div class="relative h-64 overflow-hidden rounded-sm">
                                    @if(!empty($gallery->images) && is_array($gallery->images))
                                        <img src="{{ asset('storage/' . $gallery->images[0]) }}" 
                                             alt="{{ $gallery->title }}"
                                             class="w-full h-full object-cover transition-all duration-700 group-hover:scale-115 filter grayscale group-hover:grayscale-0 group-hover:brightness-110">
                                    @else
                                        <div class="w-full h-full bg-black flex items-center justify-center">
                                            <i class="fas fa-satellite-dish text-5xl text-gray-800"></i>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                                    @if(count($gallery->images) > 1)
                                        <div class="absolute top-3 right-3 bg-black/70 text-green-300 px-3 py-1 rounded-full text-xs font-mono border border-green-800 shadow-md">
                                            +{{ count($gallery->images) - 1 }} ASSETS
                                        </div>
                                    @endif
    
                                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-green-400/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-green-400/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
        
                                <div class="p-5 flex flex-col justify-between flex-grow">
                                    <h3 class="text-xl font-semibold text-gray-200 mb-2 line-clamp-2 group-hover:text-green-300 transition-colors duration-200">
                                        {{ $gallery->title }}
                                    </h3>
                                    
                                    @if($gallery->description)
                                        <p class="text-gray-400 text-sm mb-4 line-clamp-3 leading-relaxed">
                                            {{ $gallery->description }}
                                        </p>
                                    @endif
        
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-4 font-mono border-t border-gray-800 pt-3">
                                        <span><i class="far fa-calendar-alt text-green-500 mr-1"></i> LOG_DATE: {{ $gallery->created_at->format('Y-m-d') }}</span>
                                    </div>
        
                                    <a wire:navigate href="{{ route('gallery.show', $gallery->slug) }}" 
                                       class="inline-flex items-center justify-center w-full px-4 py-2 bg-green-900/50 text-green-300 border border-green-700 text-sm font-semibold rounded-md 
                                              hover:bg-green-800/70 hover:text-white transition-all duration-300 transform hover:scale-[1.01] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                        <i class="fas fa-folder-open mr-2 text-green-400"></i>
                                        ACCESS_ARCHIVE
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
        
                    @if($galleries->hasPages())
                        <div class="flex justify-center mt-8" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                            {{ $galleries->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-16"
                         data-aos="fade-in" data-aos-duration="1000">
                        <div class="max-w-md mx-auto bg-gray-900/40 backdrop-blur-sm rounded-lg p-8 border border-green-500/20 shadow-lg">
                            <i class="fas fa-database text-gray-700 text-6xl mb-4 drop-shadow-[0_0_10px_rgba(0,0,0,0.5)]"></i>
                            <h3 class="text-xl font-mono text-gray-400 mb-3 leading-relaxed">
                                // NO_VISUAL_DATA_FOUND //
                            </h3>
                            <p class="text-gray-500 mb-6 leading-relaxed">
                                Arsip visual tidak ditemukan atau gagal didekripsi. <br>Coba cek status server atau konfigurasi indeks.
                            </p>
                            <a wire:navigate href="{{ route('home') }}" 
                               class="inline-flex items-center px-6 py-3 bg-green-700 text-white font-bold rounded-md hover:bg-green-600 transition-colors duration-300 transform hover:scale-105">
                                <i class="fas fa-home mr-2"></i>
                                KEMBALI_KE_BERANDA
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            AOS.init({
                once: true,
                mirror: false,
                duration: 800, // Adjusted duration for this page
                easing: 'ease-out-quad',
            });
            AOS.refresh();
        });
    
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                once: true,
                mirror: false,
                duration: 800,
                easing: 'ease-out-quad',
            });
        });
    </script>
    
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
        /* Shine effect for section titles */
        .animate-shine {
            animation: shine 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes shine {
            0%, 100% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(100%);
            }
        }
    </style>
</div>