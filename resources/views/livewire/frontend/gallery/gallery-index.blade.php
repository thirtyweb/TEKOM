<div>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Gallery Koleksi
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jelajahi koleksi foto dan momen terbaik kami yang telah terabadikan dengan indah
                </p>
            </div>
    
            <!-- Gallery Grid -->
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($galleries as $gallery)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <!-- Gallery Image -->
                            <div class="relative h-64 overflow-hidden group">
                                @if(!empty($gallery->images) && is_array($gallery->images))
                                    <img src="{{ asset('storage/' . $gallery->images[0]) }}" 
                                         alt="{{ $gallery->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    
                                    <!-- Images Count Badge -->
                                    @if(count($gallery->images) > 1)
                                        <div class="absolute top-3 right-3 bg-black bg-opacity-70 text-white px-2 py-1 rounded-full text-sm">
                                            <i class="fas fa-images mr-1"></i>
                                            {{ count($gallery->images) }} foto
                                        </div>
                                    @endif
                                @else
                                    <!-- Placeholder Image -->
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                            </div>
    
                            <!-- Gallery Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">
                                    {{ $gallery->title }}
                                </h3>
                                
                                @if($gallery->description)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        {{ $gallery->description }}
                                    </p>
                                @endif
    
                                <!-- Gallery Info -->
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span class="flex items-center">
                                        <i class="far fa-calendar mr-1"></i>
                                        {{ $gallery->created_at->format('d M Y') }}
                                    </span>
                                    @if(!empty($gallery->images))
                                        <span class="flex items-center">
                                            <i class="far fa-images mr-1"></i>
                                            {{ count($gallery->images) }} foto
                                        </span>
                                    @endif
                                </div>
    
                                <!-- Action Button -->
                                <a href="{{ route('gallery.show', $gallery->slug) }}" 
                                   class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <i class="far fa-eye mr-2"></i>
                                    Lihat Gallery
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
                        <i class="fas fa-images text-gray-300 text-6xl mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">
                            Belum Ada Gallery
                        </h3>
                        <p class="text-gray-500 mb-6">
                            Saat ini belum ada gallery yang tersedia. Silakan kembali lagi nanti.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    
        <!-- Custom Styles -->
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
    
            /* Custom pagination styling */
            .pagination {
                @apply flex justify-center space-x-1;
            }
            
            .pagination .page-link {
                @apply px-3 py-2 text-sm text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors duration-200;
            }
            
            .pagination .page-item.active .page-link {
                @apply bg-blue-600 text-white border-blue-600;
            }
            
            .pagination .page-item.disabled .page-link {
                @apply text-gray-300 cursor-not-allowed hover:bg-white hover:text-gray-300;
            }
        </style>
    </div>
</div>
