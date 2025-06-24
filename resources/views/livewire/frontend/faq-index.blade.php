<div>
    <style>
        .font-fira-code { font-family: 'Fira Code', monospace; }
        .cursor::after { content: '_'; animation: blink 1s step-end infinite; }
        @keyframes blink { 50% { opacity: 0; } }
        .terminal-window-boot { animation: boot-up 0.7s 0.2s ease-out forwards; opacity: 0; }
        @keyframes boot-up { from { opacity: 0; transform: scale(0.98); } to { opacity: 1; transform: scale(1); } }
        .command-input {
            background: transparent;
            border: none;
            color: white;
            flex-grow: 1;
            outline: none;
            font-family: 'Fira Code', monospace;
        }
    </style>

    <div class=" text-gray-200 min-h-screen py-12 sm:py-16 font-fira-code">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-data="interactiveTerminal()" @question-submitted.window="handleSubmission" class="bg-black/70 backdrop-blur-sm border border-green-500/30 rounded-lg shadow-2xl shadow-green-500/10 overflow-hidden terminal-window-boot">
                <div class="bg-gray-800/80 px-4 py-2 flex items-center gap-2 border-b border-green-500/30">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <p class="ml-auto text-xs text-gray-400">user@tekom: ~/faq</p>
                </div>
                
                <div class="p-4 sm:p-6" x-ref="terminalBody">
                    <div class="space-y-6 mb-8">
                        <div>
                             <div class="flex gap-2">
                                <span class="text-green-400">$</span>
                                <p class="text-gray-200">cat README.md</p>
                            </div>
                            <div class="mt-2 pl-4 text-gray-300">
                                <p>Welcome to the Tekom FAQ terminal.</p>
                                <p>To ask a new question, type <span class="text-cyan-400">'./ask'</span> at the prompt below and press Enter.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6 mb-8">
                        @foreach ($faqs as $faq)
                            <div wire:key="{{ $faq->key }}">
                                <div class="flex gap-2">
                                    <span class="text-green-400">$</span>
                                    <p class="text-gray-200">faq --show --question="{{ $faq->question }}"</p>
                                </div>
                                <div class="mt-2 pl-4 text-gray-300 prose prose-sm prose-invert max-w-none prose-p:leading-relaxed">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        @endforeach  </div>

                    <div class="space-y-6">
                        <template x-for="line in commandHistory" :key="line.id">
                            <div class="space-y-2">
                                <div class="flex gap-2">
                                    <span class="text-green-400">$</span>
                                    <p class="text-gray-200" x-text="line.command"></p>
                                </div>
                                <div x-html="line.output" class="pl-4"></div>
                            </div>
                        </template>

                        <div x-show="showForm" x-transition>
                            @if ($successMessage)
                                <div class="bg-gray-900 border border-green-500/60 rounded p-4 text-left">
                                    <p class="text-green-400">[SUCCESS] Query received and piped to /dev/admin.</p>
                                </div>
                            @else
                                <form wire:submit.prevent="submitQuestion" class="space-y-4 pl-4">
                                    <div>
                                        <label for="name" class="text-gray-400 block mb-1">nama:</label>
                                        <input type="text" wire:model.defer="name" id="name" class="w-full bg-gray-900/50 py-2 px-3 border border-gray-700 rounded-md text-white focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder-gray-500" placeholder="user@tekom">
                                        @error('name') <p class="text-red-500 text-sm mt-1">// error: {{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="text-gray-400 block mb-1">email:</label>
                                        <input type="email" wire:model.defer="email" id="email" class="w-full bg-gray-900/50 py-2 px-3 border border-gray-700 rounded-md text-white focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder-gray-500" placeholder="user@example.com">
                                        @error('email') <p class="text-red-500 text-sm mt-1">// error: {{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="question" class="text-gray-400 block mb-1">pertanyaan:</label>
                                        <textarea wire:model.defer="question" id="question" rows="4" class="w-full bg-gray-900/50 py-2 px-3 border border-gray-700 rounded-md text-white focus:ring-1 focus:ring-green-500 focus:border-green-500 placeholder-gray-500" placeholder="Tulis pertanyaan Anda di sini..."></textarea>
                                        @error('question') <p class="text-red-500 text-sm mt-1">// error: {{ $message }}</p> @enderror
                                    </div>
                                    <div class="flex items-center gap-2 pt-2">
                                        <span class="text-green-400">&gt;</span>
                                        <button type="submit" class="text-left py-1 px-3 border border-green-600 rounded-md shadow-sm text-sm font-semibold text-green-400 bg-green-900/50 hover:bg-green-800/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-black focus:ring-green-500">
                                            <span wire:loading.remove>execute_script</span>
                                            <span wire:loading>executing...</span>
                                        </button>
                                    </div>
                                </form>
                            @endif </div>
                    </div>
                    
                    <div class="mt-6" x-show="!showForm">
                        <div class="flex gap-2 items-center">
                            <span class="text-green-400">$</span>
                            <input type="text" class="command-input" placeholder="..." x-model="commandInput" @keydown.enter.prevent="handleCommand" x-ref="commandInput">
                            <div class="cursor"></div>
                        </div>
                    </div>
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
                width: 0.5px;
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

    <script>
        // Script ini tidak perlu diubah
        function interactiveTerminal() {
            return {
                commandInput: '',
                commandHistory: [],
                showForm: false,
                init() {
                    this.$nextTick(() => this.focusInput());
                },
                focusInput() {
                    this.$refs.commandInput.focus();
                },
                scrollToBottom() {
                    this.$nextTick(() => {
                        this.$el.scrollIntoView({ behavior: 'smooth', block: 'end' });
                    });
                },
                handleCommand() {
                    if (!this.commandInput.trim()) return;
                    const command = this.commandInput.trim();
                    let output = '';
                    if (command === './ask') {
                        this.showForm = true;
                        this.commandHistory.push({ id: Date.now(), command: command, output: '<p class="text-gray-400">// Opening question form...</p>' });
                    } else if (command === 'help') {
                        output = `<p class="text-cyan-400">Available commands:</p><ul class="list-disc list-inside"><li><span class="text-white">./ask</span> - Open the form to ask a new question.</li><li><span class="text-white">clear</span> - Clear the interactive session.</li><li><span class="text-white">help</span> - Show this help message.</li></ul>`;
                        this.commandHistory.push({ id: Date.now(), command: command, output: output });
                    } else if (command === 'clear') {
                        this.commandHistory = [];
                    } else {
                        output = `<p class="text-red-500">command not found: ${command}</p>`;
                        this.commandHistory.push({ id: Date.now(), command: command, output: output });
                    }
                    this.commandInput = '';
                    this.scrollToBottom();
                },
                handleSubmission() {
                    this.scrollToBottom();
                }
            }
        }
        document.addEventListener('livewire:load', function () {
            Livewire.on('questionSubmitted', () => {
                window.dispatchEvent(new CustomEvent('question-submitted'));
            });
        });
    </script>
</div>