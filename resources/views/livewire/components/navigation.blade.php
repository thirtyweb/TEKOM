<div>
<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">
                    Logo
                </a>
            </div>
            
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Beranda</a>
                
                <div class="relative group">
                    <button class="text-gray-700 hover:text-blue-600 flex items-center">
                        Artikel
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="{{ route('articles.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Semua Artikel</a>
                        @foreach($categories as $category)
                            <a href="{{ route('articles.index', ['categoryId' => $category->id]) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                
                <a href="{{ route('gallery.index') }}" class="text-gray-700 hover:text-blue-600">Galeri</a>
                <a href="{{ route('resources.index') }}" class="text-gray-700 hover:text-blue-600">Resource</a>
                <a href="{{ route('faq.index') }}" class="text-gray-700 hover:text-blue-600">FAQ</a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button class="text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
</div>
