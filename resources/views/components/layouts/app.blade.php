<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TRK' }}</title>
    <meta name="description" content="@yield('description', 'Website resmi departemen TEKOMSS')">

    {{-- Font & Icons --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Fira+Code:wght@400;600&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    {{-- KODE HIGHLIGHT.JS DIHAPUS DARI SINI --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        #hacking-simulator-container,
        #main-website-container {
            display: none;
        }

        #hacking-simulator-container.active {
            display: flex;
            font-family: 'Fira Code', monospace;
            color: #c9d1d9;
            background-color: #0d1117;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        #terminal {
            background-color: #010409;
            border: 1px solid #30363d;
            width: 100%;
            max-width: 900px;
            height: 90vh;
            overflow-y: auto;
            padding: 1.5rem;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .cursor {
            display: inline-block;
            background-color: #c9d1d9;
            width: 8px;
            height: 1.2em;
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {

            from,
            to {
                background-color: transparent
            }

            50% {
                background-color: #c9d1d9;
            }
        }


        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d1117;
        }


        #main-website-container.active {
            display: block;
            opacity: 1;
            transition: opacity 1.5s ease-in-out;
            background-color: #000000;
            background-image: linear-gradient(rgba(0, 255, 0, 0.05) 1px, transparent 1px), linear-gradient(to right, rgba(0, 255, 0, 0.05) 1px, transparent 1px);
            background-size: 2rem 2rem;
            color: #e5e7eb;
        }
    </style>

    @livewireStyles
</head>

<body class="antialiased">

    {{-- ===== CONTAINER UNTUK HACKING SIMULATOR ===== --}}
    <div id="hacking-simulator-container">
        <div id="terminal" class="rounded-lg shadow-2xl">
            <div id="output"></div>
            <div class="flex items-start mt-4">
                <span class="text-green-400">root@tekomss:~#</span>
                <span id="command-line" class="ml-2 text-blue-400"></span>
                <span class="cursor"></span>
            </div>
        </div>
    </div>

    {{-- ===== CONTAINER UNTUK WEBSITE UTAMA ANDA ===== --}}
    <div id="main-website-container">
        <header>
            <livewire:components.navigation />
        </header>
        <main class="min-h-screen">
            {{ $slot }}
        </main>
        <footer class="bg-black/50 border-t-2 border-green-500/20 pt-16 pb-8 mt-16 shadow-inner">
            <livewire:components.footer />
        </footer>
    </div>



    @livewireScripts

    <script>
        // Script Pengecekan Awal
        (function() {
            if (sessionStorage.getItem('introSeen') === 'true') {
                document.body.style.backgroundColor = '#000000';
                document.getElementById('main-website-container').classList.add('active');
            } else {
                document.getElementById('hacking-simulator-container').classList.add('active');
            }
        })();

        // Script Utama setelah DOM load
        document.addEventListener('DOMContentLoaded', () => {
            if (sessionStorage.getItem('introSeen') !== 'true') {
                const simulatorContainer = document.getElementById('hacking-simulator-container');
                const websiteContainer = document.getElementById('main-website-container');
                const output = simulatorContainer.querySelector('#output');
                const commandLine = simulatorContainer.querySelector('#command-line');
                const terminal = simulatorContainer.querySelector('#terminal');

                function printLog(message, className = 'text-gray-400') {
                    if (!output) return;
                    const p = document.createElement('p');
                    p.textContent = message;
                    p.className = className;
                    output.appendChild(p);
                    terminal.scrollTop = terminal.scrollHeight;
                }

                function typeEffect(element, text, callback) {
                    if (!element) return;
                    let i = 0;
                    const interval = setInterval(() => {
                        if (i < text.length) {
                            element.textContent += text.charAt(i);
                            i++;
                        } else {
                            clearInterval(interval);
                            if (callback) callback();
                        }
                    }, 50);
                }

                async function startHacking(target) {
                    const steps = [{
                            msg: `[+] Initiating connection to target: ${target}`,
                            delay: 500,
                            color: 'text-yellow-400'
                        },
                        {
                            msg: `[+] Authenticating with server credentials...`,
                            delay: 800
                        },
                        {
                            msg: `[!] TLS Handshake successful. Secure connection established.`,
                            delay: 1200,
                            color: 'text-green-400'
                        },
                        {
                            msg: `[+] Fetching main layout components...`,
                            delay: 800
                        },
                        {
                            msg: `[+] Compiling Blade templates...`,
                            delay: 1500
                        },
                        {
                            msg: `[+] Hydrating Livewire components...`,
                            delay: 1200
                        },
                        {
                            msg: `[!] UI render complete. Launching main thread...`,
                            delay: 800,
                            color: 'text-blue-400 font-bold'
                        }
                    ];

                    for (const step of steps) {
                        await new Promise(resolve => setTimeout(resolve, step.delay));
                        printLog(step.msg, step.color);
                    }

                    setTimeout(transitionToMainSite, 1200);
                }

                function transitionToMainSite() {
                    document.body.style.backgroundColor = '#000000';
                    simulatorContainer.style.opacity = '0';
                    websiteContainer.classList.add('active');
                    sessionStorage.setItem('introSeen', 'true');
                    simulatorContainer.addEventListener('transitionend', () => {
                        simulatorContainer.remove();
                    }, {
                        once: true
                    });
                }

                typeEffect(commandLine, 'Run Server Tekomss.ipb.ac.id', () => {
                    startHacking('tekomss.ac.id');
                });
            }
        });
    </script>

</body>

</html>