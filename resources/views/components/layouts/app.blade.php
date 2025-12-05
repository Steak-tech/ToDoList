<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <!-- Font Awesome (gardé pour vos icônes) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Vos styles compilés -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Wrapper principal : Flexbox pour mettre Sidebar et Contenu côte à côte -->
    <div class="flex min-h-screen">

        @auth
        <!-- SIDEBAR -->
        <!-- w-64 : largeur fixe. hidden md:block : caché sur mobile, visible sur écran moyen+ -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">
                    Navigation
                </p>
                
                <ul class="space-y-2">
                    <!-- Home -->
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md transition-colors">
                            <span class="w-6 text-center mr-2"><i class="fa fa-home"></i></span>
                            Home
                        </a>
                    </li>

                    <!-- Links (Active state example) -->
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 bg-gray-800 text-white rounded-md transition-colors">
                            <span class="w-6 text-center mr-2"><i class="fa fa-table"></i></span>
                            Links
                        </a>
                        
                        <!-- Submenu -->
                        <ul class="mt-2 ml-8 space-y-1 border-l border-gray-700 pl-2 text-sm">
                            <li>
                                <a href="#" class="block px-3 py-1 text-gray-400 hover:text-white transition-colors">
                                    <i class="fa fa-link mr-1 text-xs"></i> Link1
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block px-3 py-1 text-gray-400 hover:text-white transition-colors">
                                    <i class="fa fa-link mr-1 text-xs"></i> Link2
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- About -->
                    <li>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white rounded-md transition-colors">
                            <span class="w-6 text-center mr-2"><i class="fa fa-info"></i></span>
                            About
                        </a>
                    </li>

                    <!-- Logout -->
                    <li class="pt-4 mt-4 border-t border-gray-700">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 text-red-400 hover:bg-red-900/20 hover:text-red-300 rounded-md transition-colors text-left">
                                <span class="w-6 text-center mr-2"><i class="fa fa-sign-out-alt"></i></span>
                                Se déconnecter
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>
        @endauth

        <!-- COLONNE DROITE (Contenu + Footer) -->
        <!-- flex-1 : Prend toute la largeur restante -->
        <div class="flex-1 flex flex-col min-h-screen">
            
            <!-- MAIN CONTENT -->
            <main class="flex-1 p-6 md:p-8">
                {{ $slot }}
            </main>

            <!-- FOOTER -->
            <footer class="bg-white border-t border-gray-200 p-6 text-center text-gray-600 text-sm">
                <p>
                    <strong>Bulma</strong> by <a href="https://jgthms.com" class="text-blue-600 hover:underline">Jeremy Thomas</a>.
                    The source code is licensed
                    <a href="https://opensource.org/license/mit" class="text-blue-600 hover:underline">MIT</a>. The
                    website content is licensed
                    <a href="https://creativecommons.org/licenses/by-nc-sa/4.0//" class="text-blue-600 hover:underline">CC BY NC SA 4.0</a>.
                </p>
            </footer>
        </div>

    </div>
</body>
</html>