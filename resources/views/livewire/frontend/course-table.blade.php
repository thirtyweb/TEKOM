<div>
    <div>
        <div class="min-h-screen pt-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <h1 class="font-mono text-4xl font-bold text-green-300 drop-shadow-[0_0_8px_rgba(52,211,153,0.5)]">// DAFTAR_MATA_KULIAH</h1>
                    <p class="text-gray-400 mt-2">Menjelajahi kurikulum departemen secara interaktif.</p>
                </div>
        
                <div class="bg-gray-900/40 backdrop-blur-sm rounded-lg shadow-lg p-6 mb-8 border border-green-500/20">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-600"></i>
                            </div>
                            <input 
                                wire:model.live.debounce.300ms="search"
                                type="text" 
                                placeholder="Cari berdasarkan kata kunci, kode, prasyarat..."
                                class="w-full pl-10 pr-4 py-3 border border-slate-700 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-slate-800 text-gray-300 placeholder-gray-500"
                            >
                        </div>
        
                        <select wire:model.live="semester" class="w-full px-4 py-3 border border-slate-700 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-slate-800 text-gray-300">
                            <option value="">Filter Semester</option>
                            @foreach($semesterOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
        
                        <select wire:model.live="category" class="w-full px-4 py-3 border border-slate-700 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-slate-800 text-gray-300">
                            <option value="">Filter Kategori</option>
                            @foreach($categoryOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
        
                        <select wire:model.live="statusFilter" class="w-full px-4 py-3 border border-slate-700 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 bg-slate-800 text-gray-300">
                            <option value="">Filter Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
        
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t border-slate-800">
                        <button 
                            wire:click="clearFilters" 
                            class="px-4 py-2 text-sm text-gray-400 hover:text-green-300 hover:bg-green-500/10 rounded-md transition-colors duration-200 flex items-center gap-2"
                            wire:loading.attr="disabled"
                        >
                            <i class="fas fa-times-circle"></i>
                            RESET_FILTER
                        </button>
                        
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-400">Tampilkan:</span>
                            <select wire:model.live="perPage" class="px-3 py-1 border border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent bg-slate-800 text-gray-300">
                                <option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
        
                <div class="bg-gray-900/40 backdrop-blur-sm rounded-lg shadow-lg overflow-hidden border border-green-500/20">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-800/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-mono uppercase tracking-widest text-green-400/80 cursor-pointer">
                                        <div wire:click="sortBy('code')" class="flex items-center gap-2 hover:text-green-300 transition-colors">Kode</div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-mono uppercase tracking-widest text-green-400/80 cursor-pointer">
                                        <div wire:click="sortBy('name')" class="flex items-center gap-2 hover:text-green-300 transition-colors">Nama Mata Kuliah</div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-mono uppercase tracking-widest text-green-400/80">SKS</th>
                                    <th class="px-6 py-4 text-center text-xs font-mono uppercase tracking-widest text-green-400/80 cursor-pointer">
                                        <div wire:click="sortBy('semester')" class="flex items-center justify-center gap-2 hover:text-green-300 transition-colors">Semester</div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-mono uppercase tracking-widest text-green-400/80">Prasyarat</th>
                                    <th class="px-6 py-4 text-left text-xs font-mono uppercase tracking-widest text-green-400/80">Kategori</th>
                                    <th class="px-6 py-4 text-center text-xs font-mono uppercase tracking-widest text-green-400/80">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                @forelse($courses as $course)
                                    <tr class="hover:bg-green-500/5 transition-colors duration-150" wire:key="course-{{ $course->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-mono bg-green-900/50 text-green-300 border border-green-800">
                                                {{ $course->code }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-200 leading-relaxed">{{ $course->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="font-mono text-green-300">{{ $course->sks }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm text-gray-400">{{ $course->semester }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500 max-w-xs truncate" title="{{ $course->prerequisite ?: 'N/A' }}">
                                                {{ $course->prerequisite ?: 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-400">{{ $course->category }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono border {{ $course->is_active ? 'bg-green-900/50 text-green-300 border-green-700' : 'bg-red-900/50 text-red-300 border-red-700' }}">
                                                <div class="w-2 h-2 rounded-full {{ $course->is_active ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                                {{ $course->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <i class="fas fa-database text-5xl text-gray-700 mb-4"></i>
                                                <h3 class="text-lg font-mono text-gray-400 mb-2">// QUERY_TIDAK_DITEMUKAN //</h3>
                                                <p class="text-gray-500">Coba ubah parameter filter atau sinkronisasi data.</p>
                                                <button wire:click="clearFilters" class="mt-4 px-4 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors font-mono">
                                                    RESET_FILTER
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                    @if($courses->hasPages())
                        <div class="px-6 py-4 border-t border-gray-800">
                            {{ $courses->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
        
                <div class="mt-8 bg-black/20 rounded-lg p-6 text-white border border-green-500/10">
                    <h3 class="text-lg font-mono text-green-300 mb-4">// STATISTIK_KURIKULUM</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-slate-800/50 p-4 rounded-md border-l-4 border-green-500">
                            <div class="text-3xl font-bold font-mono">{{ $courses->total() }}</div>
                            <div class="text-gray-400 text-sm">Total Mata Kuliah</div>
                        </div>
                        <div class="bg-slate-800/50 p-4 rounded-md border-l-4 border-green-500">
                            <div class="text-3xl font-bold font-mono">{{ \App\Models\Course::active()->count() }}</div>
                            <div class="text-gray-400 text-sm">Mata Kuliah Aktif</div>
                        </div>
                        <div class="bg-slate-800/50 p-4 rounded-md border-l-4 border-green-500">
                            <div class="text-3xl font-bold font-mono">{{ \App\Models\Course::distinct('semester')->count('semester') }}</div>
                            <div class="text-gray-400 text-sm">Semester Tersedia</div>
                        </div>
                        <div class="bg-slate-800/50 p-4 rounded-md border-l-4 border-green-500">
                            <div class="text-3xl font-bold font-mono">{{ \App\Models\Course::distinct('category')->count('category') }}</div>
                            <div class="text-gray-400 text-sm">Kategori Unik</div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div wire:loading.delay class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-300">
                <div class="flex items-center gap-4">
                    <svg class="animate-spin h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <div class="font-medium text-green-300 font-mono">Memproses Permintaan...</div>
                </div>
            </div>
        </div>
    </div>
    
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
    </style>
</div>