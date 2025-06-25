<div>
    <footer class="bg-gradient-to-b from-black/60 to-black border-t-2 border-green-500/20 pt-16 pb-8 mt-24 shadow-[0_-10px_30px_rgba(0,255,0,0.05)] relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-5" style="background: repeating-linear-gradient(0deg, rgba(0,255,0,0.02) 1px, transparent 1px, transparent 10px), repeating-linear-gradient(90deg, rgba(0,255,0,0.02) 1px, transparent 1px, transparent 10px);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 lg:gap-12">

                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                    <h3 class="font-mono text-lg font-bold text-green-300 mb-4 tracking-wider relative group">
                        <span class="inline-block relative z-10">&gt; ABOUT US</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed border-l-2 border-green-700/50 pl-3">Program studi Teknologi Rekayasa Komputer berfokus pada rekayasa cerdas sistem komputer. Kami mengembangkan inovasi modern dan menerapkannya untuk pengabdian masyarakat.</p>

                    <div class="mt-6 flex space-x-5">
                        <a wire:navigate href="#" class="text-gray-500 hover:text-green-400 transition-all duration-300 transform hover:scale-125 hover:rotate-3">
                            <i class="fab fa-facebook-f text-lg drop-shadow-[0_0_5px_rgba(0,255,0,0.3)]"></i>
                        </a>
                        <a wire:navigate href="#" class="text-gray-500 hover:text-green-400 transition-all duration-300 transform hover:scale-125 hover:rotate-3">
                            <i class="fab fa-twitter text-lg drop-shadow-[0_0_5px_rgba(0,255,0,0.3)]"></i>
                        </a>
                        <a wire:navigate href="#" class="text-gray-500 hover:text-green-400 transition-all duration-300 transform hover:scale-125 hover:rotate-3">
                            <i class="fab fa-instagram text-lg drop-shadow-[0_0_5px_rgba(0,255,0,0.3)]"></i>
                        </a>
                        <a wire:navigate href="#" class="text-gray-500 hover:text-green-400 transition-all duration-300 transform hover:scale-125 hover:rotate-3">
                            <i class="fab fa-youtube text-lg drop-shadow-[0_0_5px_rgba(0,255,0,0.3)]"></i>
                        </a>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <h3 class="font-mono text-lg font-bold text-green-300 mb-4 tracking-wider relative group">
                        <span class="inline-block relative z-10">// QUICK LINKS</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li><a wire:navigate href="{{ route('home') }}" class="text-gray-400 hover:text-white flex items-center transition-all duration-200 group relative">
                            <span class="text-green-400 mr-2 transform translate-x-0 group-hover:translate-x-1 transition-transform duration-200">&gt;</span> Beranda
                            <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-green-500 group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                        <li><a wire:navigate href="{{ route('articles.index') }}" class="text-gray-400 hover:text-white flex items-center transition-all duration-200 group relative">
                            <span class="text-green-400 mr-2 transform translate-x-0 group-hover:translate-x-1 transition-transform duration-200">&gt;</span> Artikel
                            <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-green-500 group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                        <li><a wire:navigate href="{{ route('gallery.index') }}" class="text-gray-400 hover:text-white flex items-center transition-all duration-200 group relative">
                            <span class="text-green-400 mr-2 transform translate-x-0 group-hover:translate-x-1 transition-transform duration-200">&gt;</span> Galeri
                            <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-green-500 group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                        <li><a wire:navigate href="{{ route('resources.index') }}" class="text-gray-400 hover:text-white flex items-center transition-all duration-200 group relative">
                            <span class="text-green-400 mr-2 transform translate-x-0 group-hover:translate-x-1 transition-transform duration-200">&gt;</span> Resource
                            <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-green-500 group-hover:w-full transition-all duration-300"></span>
                        </a></li>
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <h3 class="font-mono text-lg font-bold text-green-300 mb-4 tracking-wider relative group">
                        <span class="inline-block relative z-10">// CONTACT</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </h3>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-green-400/70 drop-shadow-[0_0_3px_rgba(0,255,0,0.5)]"></i>
                            <span>Sector 7G, Neo-Akademik City</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-green-400/70 drop-shadow-[0_0_3px_rgba(0,255,0,0.5)]"></i>
                            <span>+62 (21) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-green-400/70 drop-shadow-[0_0_3px_rgba(0,255,0,0.5)]"></i>
                            <span>info@tekomss.net</span>
                        </li>
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="450">
                    <h3 class="font-mono text-lg font-bold text-green-300 mb-4 tracking-wider relative group">
                        <span class="inline-block relative z-10">// INSPIRATION</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </h3>
                    <div class="border border-gray-800 bg-gray-900/40 p-4 rounded-md shadow-inner-lg shadow-green-900/20 backdrop-blur-sm">
                        <livewire:components.quote-of-the-day />
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-10 pt-8 text-center text-gray-600 text-xs font-mono relative">
                <p>&copy; {{ date('Y') }} TEKOMSS Data Hub // All rights reserved // TIM TEKOM</p>
                <span class="absolute right-1/2 translate-x-1/2 bottom-5 w-2 h-3 bg-green-500 animate-flicker"></span>
            </div>
        </div>
    </footer>

    <style>
        /* For the flickering cursor effect */
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        .animate-flicker {
            animation: flicker 1.2s infinite step-end;
        }

        /* Custom shadow for inner effect */
        .shadow-inner-lg {
            box-shadow: inset 0 2px 10px rgba(0, 255, 0, 0.1), inset 0 -2px 10px rgba(0, 255, 0, 0.1);
        }
    </style>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            AOS.init({
                once: true,
                mirror: false,
                duration: 1000,
                easing: 'ease-out-quad',
            });
            AOS.refresh();
        });

        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                once: true,
                mirror: false,
                duration: 1000,
                easing: 'ease-out-quad',
            });
        });
    </script>
</div>