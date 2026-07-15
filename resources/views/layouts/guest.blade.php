<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Fallback for uncompiled Tailwind classes -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            tokopedia: {
                                DEFAULT: '#03AC0E',
                                dark: '#008C0A',
                                light: '#E5F7E6',
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            body {
                font-family: 'Outfit', sans-serif;
            }
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
        </style>
    </head>
    <body class="text-gray-900 antialiased selection:bg-tokopedia selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 relative overflow-hidden z-0">
            
            <!-- Animated Background Gradient Blobs -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
                <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-tokopedia rounded-full mix-blend-multiply filter blur-[100px] opacity-30 animate-blob"></div>
                <div class="absolute top-[20%] right-[-10%] w-96 h-96 bg-green-400 rounded-full mix-blend-multiply filter blur-[100px] opacity-30 animate-blob animation-delay-2000"></div>
                <div class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-30 animate-blob animation-delay-4000"></div>
            </div>

            <div>
                <a href="/">
                    <!-- Replaced default logo with a more prominent stylized text or icon placeholder -->
                    <div class="flex items-center gap-2 mb-4 group cursor-pointer">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-tokopedia to-tokopedia-dark flex items-center justify-center shadow-lg shadow-tokopedia/30 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <span class="text-3xl font-bold text-gray-800 tracking-tight">Toko<span class="text-tokopedia">Kita</span></span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-white/95 backdrop-blur-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden sm:rounded-3xl border border-white/20 transition-all hover:shadow-[0_8px_40px_rgb(0,0,0,0.16)] relative">
                
                <!-- Decorative top border line -->
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-tokopedia via-green-400 to-tokopedia-dark"></div>
                
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} TokoKita. All rights reserved.
            </div>
        </div>
    </body>
</html>
