<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NotionMMI' }}</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased relative selection:bg-indigo-500 selection:text-white">

    <!-- ARRIÈRE-PLAN ANIMÉ (Global pour toute l'app) -->
    <div class="fixed inset-0 -z-50 pointer-events-none">
        <!-- Texture grain -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiIHZpZXdCb3g9IjAgMCA0IDQiPjxwYXRoIGZpbGw9IiM5OTkiIGZpbGwtb3BhY2l0eT0iLjEiIGQ9Ik0xIDNoMXYxSDFVLTFtMSAwSDJ2MUgxWiIvPjwvc3ZnPg==')] opacity-20 mix-blend-soft-light"></div>
        
        <!-- Blobs -->
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-purple-400/20 rounded-full blur-3xl animate-[spin_25s_linear_infinite]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-indigo-500/20 rounded-full blur-3xl animate-[bounce_15s_infinite]"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-blue-300/10 rounded-full blur-3xl animate-pulse"></div>
    </div>

    <!-- Wrapper principal -->
     
    <div class="flex min-h-screen">
        
        
        @auth
        <!-- SIDEBAR (Dark Glass Style) -->
        <aside class="w-64 bg-slate-900/85 backdrop-blur-xl border-r border-white/10 text-gray-300 flex-shrink-0 hidden md:flex flex-col relative z-20 transition-all duration-300 max-h-screen">
            
            <!-- Logo Sidebar -->
            <div class="h-16 flex items-center px-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <span class="text-white font-bold text-sm">N</span>
                    </div>
                    <span class="font-bold text-lg text-white tracking-tight">Notion<span class="text-indigo-400">MMI</span></span>
                </div>
            </div>

            <!-- Menu -->
            <div class="p-4 flex-1 overflow-y-auto"> 
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-2">
                    Menu Principal
                </p>
                
                <ul class="space-y-1">
                    <!-- Home -->
                    <li>
                        <a href="/" class="group flex items-center px-4 py-2.5 rounded-lg hover:bg-white/10 hover:text-white transition-all duration-200">
                            <span class="w-6 mr-3 text-center text-gray-400 group-hover:text-indigo-400 transition-colors">
                                <i class="fa fa-home"></i>
                            </span>
                            <span class="font-medium">Home</span>
                        </a>
                    </li>

                    <!-- Links (Active state styled) -->
                    <li>
                        <!-- État actif simulé (bg-white/10 + text-white) -->
                        <a href="/tasks" class="group flex items-center px-4 py-2.5 rounded-lg  text-white hover:bg-white/10 transition-all duration-200">
                            <span class="w-6 mr-3 text-center text-indigo-400">
                                <i class="fa fa-table"></i>
                            </span>
                            <span class="font-medium">Vos ToDoLists</span>
                        </a>
                    </li>

                    <!-- Notes -->
                    <li>
                        <a href="/notes" class="group flex items-center px-4 py-2.5 rounded-lg hover:bg-white/10 hover:text-white transition-all duration-200">
                            <span class="w-6 mr-3 text-center text-gray-400 group-hover:text-indigo-400 transition-colors">
                                <i class="fa fa-sticky-note"></i>
                            </span>
                            <span class="font-medium">Vos Notes</span>
                        </a>
                    </li>

                    <!-- Links -->
                    <li>
                        <a href="/links" class="group flex items-center px-4 py-2.5 rounded-lg hover:bg-white/10 hover:text-white transition-all duration-200">
                            <span class="w-6 mr-3 text-center text-gray-400 group-hover:text-indigo-400 transition-colors">
                                <i class="fa fa-link"></i>
                            </span>
                            <span class="font-medium">Ressources & Veille</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Footer Sidebar (User & Logout) -->
            <div class="p-4 border-t border-white/10 bg-black/20">
                <div class="flex items-center gap-3 mb-4 px-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-gray-700 to-gray-600 border border-white/20"></div>
                    <div class="text-sm">
                        <p class="text-white font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Étudiant</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full group flex items-center justify-center px-4 py-2 text-sm text-red-400 bg-red-500/10 border border-red-500/20 rounded-lg hover:bg-red-500 hover:text-white transition-all duration-200">
                        <i class="fa fa-sign-out-alt mr-2 group-hover:rotate-180 transition-transform"></i>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>
        @endauth

        <!-- COLONNE DROITE (Contenu) -->
        <div class="flex-1 flex flex-col min-h-screen relative z-10">
            <!-- MAIN CONTENT -->
            <!-- J'ajoute un léger padding global et je laisse le fond transparent pour voir les blobs -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>
</html>