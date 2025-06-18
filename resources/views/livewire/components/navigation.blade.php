<div>
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 flex items-center justify-center">
                            <span class="text-white font-bold">R</span>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">TEKOMSS</span>
                    </a>
                </div>
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="relative group text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">
                        Beranda
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                    <div class="relative group">
                        <button class="flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">
                            Artikel
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-56 origin-top-right bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 opacity-0 scale-95 invisible group-hover:opacity-100 group-hover:scale-100 group-hover:visible transition-all duration-200 transform-gpu z-50">
                            <div class="py-1">
                                <a href="{{ route('articles.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors duration-150">Semua Artikel</a>
                                @foreach($categories as $category)
                                <a href="{{ route('articles.index', ['categoryId' => $category->id]) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors duration-150">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('gallery.index') }}" class="relative group text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">
                        Galeri
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                    <a href="{{ route('resources.index') }}" class="relative group text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">
                        Resource
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                    <a href="{{ route('faq.index') }}" class="relative group text-gray-700 hover:text-blue-600 transition-colors duration-200 font-medium">
                        FAQ
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</div>