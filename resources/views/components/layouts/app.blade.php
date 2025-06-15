<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website')</title>
    <meta name="description" content="@yield('description', 'Website description')">
    
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <livewire:components.navigation />
    
    <!-- Main Content -->
    <main>
        {{ $slot }} 
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tentang Kami</h3>
                    <p class="text-gray-300">Website ini menyediakan berbagai artikel, galeri, dan resource yang bermanfaat.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="text-gray-300 space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white">Artikel</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-white">Galeri</a></li>
                        <li><a href="{{ route('resources.index') }}" class="hover:text-white">Resource</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="text-gray-300 space-y-2">
                        <li>Email: info@website.com</li>
                        <li>Telepon: (021) 123-4567</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quote of the Day</h3>
                    <livewire:components.quote-of-the-day />
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Website. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    @livewireScripts
</body>
</html>