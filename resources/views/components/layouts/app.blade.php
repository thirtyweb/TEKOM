<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website')</title>
    <meta name="description" content="@yield('description', 'Website description')">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
    />
    
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!--style-->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%,
            100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .nav-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .mobile-menu.active {
            max-height: 500px;
        }
    </style>

    <!-- Livewire Styles -->
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
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8" data-aos="fade-up">
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <div class="w-6 h-6 gradient-bg rounded-md mr-2 flex items-center justify-center">
                            <i class="fas fa-university text-xs text-white"></i>
                        </div>
                        Tentang Kami
                    </h3>
                    <p class="text-gray-400">Website resmi departemen kami yang menyediakan berbagai informasi, artikel, dan resource pendidikan.</p>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <div class="w-6 h-6 gradient-bg rounded-md mr-2 flex items-center justify-center">
                            <i class="fas fa-bars text-xs text-white"></i>
                        </div>
                        Menu
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i> Beranda</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i> Artikel</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i> Galeri</a></li>
                        <li><a href="{{ route('resources.index') }}" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-chevron-right text-xs mr-2"></i> Resource</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <div class="w-6 h-6 gradient-bg rounded-md mr-2 flex items-center justify-center">
                            <i class="fas fa-envelope text-xs text-white"></i>
                        </div>
                        Kontak
                    </h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-sm flex-shrink-0"></i>
                            <span>Jl. Pendidikan No. 123, Kota Akademik</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-sm"></i>
                            <span>(021) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-sm"></i>
                            <span>info@department.edu</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <div class="w-6 h-6 gradient-bg rounded-md mr-2 flex items-center justify-center">
                            <i class="fas fa-quote-left text-xs text-white"></i>
                        </div>
                        Quote of the Day
                    </h3>
                    <livewire:components.quote-of-the-day />
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm" data-aos="fade-up">
                <p>&copy; {{ date('Y') }} Department Website. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    
    @livewireScripts
</body>
</html>