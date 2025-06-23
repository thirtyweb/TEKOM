<div>
    <div>
        <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8 text-center md:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">📚 Mata Kuliah</h1>
                    <p class="text-gray-600">Kelola dan pantau mata kuliah dengan mudah</p>
                </div>
        
                <!-- Filters Card -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-8 border border-white/20">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <!-- Search -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input 
                                wire:model.live.debounce.300ms="search"
                                type="text" 
                                placeholder="Cari mata kuliah, kode, atau prasyarat..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                            >
                        </div>
        
                        <!-- Semester Filter -->
                        <select wire:model.live="semester" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                            <option value="">Semua Semester</option>
                            @foreach($semesterOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
        
                        <!-- Category Filter -->
                        <select wire:model.live="category" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($categoryOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
        
                        <!-- Status Filter -->
                        <select wire:model.live="statusFilter" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white">
                            <option value="">Semua Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
        
                    <!-- Clear Filters & Per Page -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <button 
                            wire:click="clearFilters" 
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-colors duration-200 flex items-center gap-2"
                            wire:loading.attr="disabled"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Clear Filters
                        </button>
                        
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">Show:</span>
                            <select wire:model.live="perPage" class="px-3 py-1 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
        
                <!-- Table Card -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden border border-white/20">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider cursor-pointer">
                                        <div wire:click="sortBy('code')" class="flex items-center gap-2 hover:text-blue-200 transition-colors">
                                            Kode
                                            @if($sortField === 'code')
                                                <x-sort-icon :direction="$sortDirection" />
                                            @endif
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider cursor-pointer">
                                        <div wire:click="sortBy('name')" class="flex items-center gap-2 hover:text-blue-200 transition-colors">
                                            Nama Mata Kuliah
                                            @if($sortField === 'name')
                                                <x-sort-icon :direction="$sortDirection" />
                                            @endif
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">SKS</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider cursor-pointer">
                                        <div wire:click="sortBy('semester')" class="flex items-center gap-2 hover:text-blue-200 transition-colors justify-center">
                                            Semester
                                            @if($sortField === 'semester')
                                                <x-sort-icon :direction="$sortDirection" />
                                            @endif
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Prasyarat</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($courses as $course)
                                    <tr class="hover:bg-blue-50 transition-colors duration-150" wire:key="course-{{ $course->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                {{ $course->code }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900 leading-relaxed">
                                                {{ $course->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-800 border border-green-200">
                                                {{ $course->sks }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border
                                                {{ match($course->semester) {
                                                    1, 2 => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    3, 4 => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                    5, 6 => 'bg-green-100 text-green-800 border-green-200',
                                                    7, 8 => 'bg-red-100 text-red-800 border-red-200',
                                                    default => 'bg-gray-100 text-gray-800 border-gray-200'
                                                } }}">
                                                Semester {{ $course->semester }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600 max-w-xs truncate" title="{{ $course->prerequisite ?: 'Tidak ada' }}">
                                                {{ $course->prerequisite ?: 'Tidak ada' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200 leading-relaxed">
                                                {{ $course->category }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $course->is_active ? 'bg-green-100 text-green-800 border-green-200' : 'bg-red-100 text-red-800 border-red-200' }} border">
                                                <div class="w-2 h-2 rounded-full {{ $course->is_active ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                                {{ $course->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada mata kuliah ditemukan</h3>
                                                <p class="text-gray-500">Coba ubah filter pencarian atau tambah mata kuliah baru.</p>
                                                <button wire:click="clearFilters" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                                    Reset Filters
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                    <!-- Pagination -->
                    @if($courses->hasPages())
                        <div class="bg-white px-6 py-4 border-t border-gray-200">
                            {{ $courses->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
        
                <!-- Stats Card -->
                <div class="mt-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">Statistik Mata Kuliah</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                            <div class="text-3xl font-bold">{{ $courses->total() }}</div>
                            <div class="text-indigo-200 text-sm">Total Mata Kuliah</div>
                        </div>
                        <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                            <div class="text-3xl font-bold">{{ \App\Models\Course::active()->count() }}</div>
                            <div class="text-indigo-200 text-sm">Mata Kuliah Aktif</div>
                        </div>
                        <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                            <div class="text-3xl font-bold">{{ \App\Models\Course::distinct('semester')->count('semester') }}</div>
                            <div class="text-indigo-200 text-sm">Semester Tersedia</div>
                        </div>
                        <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                            <div class="text-3xl font-bold">{{ \App\Models\Course::distinct('category')->count('category') }}</div>
                            <div class="text-indigo-200 text-sm">Kategori Tersedia</div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Loading State -->
            <div wire:loading.delay class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-300">
                <div class="bg-white rounded-xl p-6 flex items-center gap-4 shadow-2xl">
                    <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <div>
                        <div class="font-medium text-gray-700">Memproses data...</div>
                        <div class="text-sm text-gray-500">Harap tunggu sebentar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>