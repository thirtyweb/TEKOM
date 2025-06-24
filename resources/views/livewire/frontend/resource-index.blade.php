<div>
    <div class="space-y-10 py-16 md:py-20 bg-black bg-[linear-gradient(to_right,rgba(0,255,0,0.05)_1px,transparent_1px),linear-gradient(to_bottom,rgba(0,255,0,0.05)_1px,transparent_1px)] bg-[size:2rem_2rem] text-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
            <div class="text-center mb-12 md:mb-16" data-aos="fade-zoom-in" data-aos-duration="1000">
                <h1 class="text-4xl md:text-5xl font-bold text-green-300 mb-4 relative inline-block drop-shadow-[0_0_15px_rgba(52,211,153,0.4)]">
                    Pusat Sumber Daya
                    <span class="absolute left-1/2 transform -translate-x-1/2 bottom-0 w-32 h-1 bg-green-500 rounded-full opacity-70 animate-shine"></span>
                </h1>
                <p class="text-lg md:text-xl text-gray-500 max-w-3xl mx-auto mt-4">
                    Temukan berbagai dokumen, panduan, dan materi edukasi yang kami sediakan.
                </p>
            </div>
    
            <div class="mb-10" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari sumber daya..."
                       class="w-full p-4 rounded-lg bg-gray-800 border border-green-700 text-white placeholder-gray-500
                              focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent
                              transition-all duration-300 ease-in-out text-lg shadow-inner shadow-green-900/20">
            </div>
    
            @if ($resources->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($resources as $index => $resource)
                        <div wire:key="resource-{{ $resource->id }}"
                             class="group relative overflow-hidden rounded-lg border border-green-500/30 bg-gray-900/50 p-6 shadow-lg
                                    transform transition-all duration-500 ease-out hover:scale-102 hover:shadow-[0_0_35px_rgba(52,211,153,0.4)] hover:border-green-500/80
                                    flex flex-col justify-between"
                             data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ $index * 150 }}">
                            
                            <div>
                                <div class="flex items-center mb-4 text-green-400">
                                    @if ($resource->file_type === 'pdf')
                                        <i class="fas fa-file-pdf text-3xl mr-3 opacity-80 group-hover:opacity-100 transition-opacity"></i>
                                    @elseif (in_array($resource->file_type, ['doc', 'docx']))
                                        <i class="fas fa-file-word text-3xl mr-3 opacity-80 group-hover:opacity-100 transition-opacity"></i>
                                    @else
                                        <i class="fas fa-file text-3xl mr-3 opacity-80 group-hover:opacity-100 transition-opacity"></i>
                                    @endif
                                    <span class="text-sm font-mono bg-green-900/50 text-green-200 px-3 py-1 rounded-full border border-green-800/70">{{ strtoupper($resource->file_type) }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-green-300 transition-colors duration-200 leading-snug">
                                    {{ $resource->title }}
                                </h3>
                                <p class="text-gray-400 text-sm line-clamp-3 mb-4">
                                    {{ $resource->description ?: 'Tidak ada deskripsi tersedia untuk sumber daya ini.' }}
                                </p>
                            </div>
    
                            <div class="mt-auto pt-4 border-t border-gray-700/50">
                                <div class="flex justify-between items-center text-xs text-gray-500 mb-3">
                                    <span><i class="fas fa-file-alt text-green-500 mr-1"></i> Ukuran: <span class="font-medium text-gray-400">{{ $resource->file_size_human }}</span></span>
                                    <span><i class="fas fa-download text-green-500 mr-1"></i> Unduhan: <span class="font-medium text-gray-400">{{ $resource->download_count }}</span></span>
                                </div>
                                <button wire:click="downloadResource({{ $resource->id }})"
                                        class="w-full inline-flex items-center justify-center px-6 py-3 bg-green-600 text-black font-extrabold rounded-md shadow-md overflow-hidden
                                               hover:bg-green-500 transition-all duration-300 ease-in-out group transform hover:scale-105
                                               relative z-10 before:content-[''] before:absolute before:inset-0 before:bg-gradient-to-r before:from-green-400 before:to-green-700 before:opacity-0 group-hover:before:opacity-100 before:transition-opacity before:duration-300">
                                    <span class="relative z-10 text-white group-hover:text-black transition-colors duration-200">
                                        Unduh Sekarang
                                    </span>
                                    <span class="absolute right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-full group-hover:translate-x-0">
                                        <i class="fas fa-arrow-circle-down text-black"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
    
                <div class="mt-12">
                    {{ $resources->links() }}
                </div>
            @else
                <div class="text-center py-10 border border-dashed border-green-700/50 rounded-lg bg-gray-900/30 backdrop-blur-sm"
                     data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <i class="fas fa-box-open text-6xl text-gray-700 mb-4"></i>
                    <p class="text-xl text-gray-500 font-semibold mb-2">Tidak ada sumber daya ditemukan.</p>
                    <p class="text-md text-gray-600">Coba sesuaikan pencarian Anda atau periksa kembali nanti.</p>
                </div>
            @endif
    
        </div>
    </div>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            AOS.init({
                once: true, // Animation should happen only once - while scrolling down
                mirror: false, // Elements should NOT animate out while scrolling past them
                duration: 1000, // Default duration for AOS animations
                easing: 'ease-out-quad', // Default easing for AOS animations
            });
            AOS.refresh(); // Refresh AOS when Livewire navigation occurs to detect new elements
        });
    
        // Also initialize on initial page load (for first visit or hard refresh)
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                once: true,
                mirror: false,
                duration: 1000,
                easing: 'ease-out-quad',
            });
        });
    </script>
    
    <style>
        /* Custom Tailwind utility for text glow */
        .text-shadow-glow {
            text-shadow: 0 0 8px rgba(0, 255, 0, 0.6), 0 0 15px rgba(0, 255, 0, 0.3);
        }
    
        /* Pulse animation for the small text and quote icon */
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .6;
            }
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
    
        /* Custom scrollbar for a futuristic feel (optional) */
        ::-webkit-scrollbar {
            width: 8px;
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
    
        /* Override default pagination styling to match dark theme */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            padding: 0;
            margin-top: 2.5rem;
        }
    
        .pagination li {
            margin: 0 0.25rem;
        }
    
        .pagination li span,
        .pagination li a {
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            font-weight: 600;
            min-width: 2.5rem;
            text-align: center;
        }
    
        .pagination li.active span {
            background-color: #10B981; /* green-500 */
            color: #000; /* black */
            cursor: default;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
    
        .pagination li a {
            background-color: #374151; /* gray-700 */
            color: #D1D5DB; /* gray-300 */
        }
    
        .pagination li a:hover:not(.active) {
            background-color: #4B5563; /* gray-600 */
            color: #fff;
            box-shadow: 0 2px 10px rgba(55, 65, 81, 0.3);
        }
    
        .pagination li.disabled span,
        .pagination li.disabled a {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</div>
