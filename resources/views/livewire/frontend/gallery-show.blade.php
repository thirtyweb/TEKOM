<div>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
                    <span>/</span>
                    <a href="{{ route('gallery.index') }}" class="hover:text-blue-600">Gallery</a>
                    <span>/</span>
                    <span class="text-gray-900">{{ $gallery->title }}</span>
                </nav>
                
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $gallery->title }}</h1>
                        @if($gallery->description)
                            <p class="text-lg text-gray-600 max-w-3xl">{{ $gallery->description }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">
                            <i class="far fa-calendar mr-1"></i>
                            {{ $gallery->created_at->format('d F Y') }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="far fa-images mr-1"></i>
                            {{ count($gallery->images) }} foto
                        </p>
                    </div>
                </div>
            </div>
    
            <!-- Gallery Grid -->
            @if(!empty($gallery->images) && count($gallery->images) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
                    @foreach($gallery->images as $index => $image)
                        <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer"
                             wire:click="openModal({{ $index }})">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="{{ $gallery->title }} - Image {{ $index + 1 }}"
                                 class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="fas fa-search-plus text-white text-2xl"></i>
                                </div>
                            </div>
                            
                            <!-- Image Number -->
                            <div class="absolute top-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                                {{ $index + 1 }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <i class="fas fa-images text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500">Tidak ada gambar dalam gallery ini.</p>
                </div>
            @endif
    
            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('gallery.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Gallery
                </a>
            </div>
        </div>
    
        <!-- Modal Lightbox -->
        @if($showModal && !empty($gallery->images))
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90"
                 wire:click="closeModal">
                
                <!-- Modal Content -->
                <div class="relative max-w-7xl max-h-full mx-4" wire:click.stop>
                    <!-- Close Button -->
                    <button wire:click="closeModal" 
                            class="absolute -top-12 right-0 text-white hover:text-gray-300 text-2xl z-10">
                        <i class="fas fa-times"></i>
                    </button>
                    
                    <!-- Image Counter -->
                    <div class="absolute -top-12 left-0 text-white text-lg z-10">
                        {{ $currentImageIndex + 1 }} / {{ count($gallery->images) }}
                    </div>
    
                    <!-- Main Image -->
                    <div class="relative">
                        <img src="{{ asset('storage/' . $gallery->images[$currentImageIndex]) }}" 
                             alt="{{ $gallery->title }}"
                             class="max-w-full max-h-[80vh] object-contain mx-auto rounded-lg">
                        
                        <!-- Navigation Arrows -->
                        @if(count($gallery->images) > 1)
                            <button wire:click="previousImage" 
                                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-3 rounded-full transition-all duration-200">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            
                            <button wire:click="nextImage" 
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-3 rounded-full transition-all duration-200">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif
                    </div>
    
                    <!-- Thumbnail Navigation -->
                    @if(count($gallery->images) > 1)
                        <div class="flex justify-center mt-4 space-x-2 max-w-full overflow-x-auto pb-2">
                            @foreach($gallery->images as $index => $image)
                                <button wire:click="goToImage({{ $index }})" 
                                        class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 transition-all duration-200 
                                               {{ $index === $currentImageIndex ? 'border-blue-500' : 'border-transparent hover:border-gray-400' }}">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         alt="Thumbnail {{ $index + 1 }}"
                                         class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    
    <!-- Scripts for keyboard navigation -->
    <script>
        document.addEventListener('livewire:init', () => {
            let modalOpen = false;
            
            Livewire.on('modal-opened', () => {
                modalOpen = true;
                document.body.style.overflow = 'hidden';
            });
            
            Livewire.on('modal-closed', () => {
                modalOpen = false;
                document.body.style.overflow = '';
            });
            
            document.addEventListener('keydown', (e) => {
                if (!modalOpen) return;
                
                switch(e.key) {
                    case 'Escape':
                        Livewire.dispatch('closeModal');
                        break;
                    case 'ArrowLeft':
                        Livewire.dispatch('previousImage');
                        break;
                    case 'ArrowRight':
                        Livewire.dispatch('nextImage');
                        break;
                }
            });
        });
    </script>
    
    <style>
        /* Smooth transitions for modal */
        .modal-enter {
            opacity: 0;
            transform: scale(0.9);
        }
        
        .modal-enter-active {
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.3s, transform 0.3s;
        }
        
        /* Custom scrollbar for thumbnails */
        .overflow-x-auto::-webkit-scrollbar {
            height: 4px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 2px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 2px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</div>
