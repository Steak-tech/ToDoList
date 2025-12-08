<div class="relative w-full h-full min-h-[80vh] flex flex-col items-center justify-center overflow-hidden bg-white/50 backdrop-blur-sm border border-gray-100 p-8">

<div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiIHZpZXdCb3g9IjAgMCA0IDQiPjxwYXRoIGZpbGw9IiM5OTkiIGZpbGwtb3BhY2l0eT0iLjEiIGQ9Ik0xIDNoMXYxSDFVLTFtMSAwSDJ2MUgxWiIvPjwvc3ZnPg==')] opacity-20 mix-blend-soft-light"></div>

        <div class="absolute top-[-20%] left-[-20%] w-[500px] h-[500px] animate-[spin_20s_linear_infinite]">
             <div class="w-full h-full rounded-full bg-gradient-to-br from-purple-400/40 to-pink-400/40 blur-3xl animate-pulse"></div>
        </div>
        
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] animate-[bounce_15s_infinite]">
            <div class="w-full h-full rounded-full bg-gradient-to-tr from-indigo-500/30 to-blue-400/30 blur-3xl"></div>
        </div>

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px]">
             <div class="w-full h-full rounded-full bg-gradient-to-r from-cyan-300/20 to-teal-300/20 blur-2xl animate-[pulse_8s_cubic-bezier(0.4,0,0.6,1)_infinite]"></div>
        </div>
    </div>

    <div class="mb-10 flex items-center justify-center space-x-4 relative z-10">
        <div class="group relative flex items-center justify-center w-20 h-20 rounded-2xl shadow-xl transition-all duration-500 hover:scale-105 hover:rotate-0 rotate-6">
            <div class="absolute inset-0 rounded-2xl bg-white/10 backdrop-blur-md border border-white/30 shadow-[inset_0_0_20px_rgba(255,255,255,0.2)]"></div>
            <div class="absolute -inset-0.5 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-500 -z-10"></div>
            
            <span class="relative text-4xl font-extrabold bg-gradient-to-br from-white via-indigo-100 to-indigo-200 bg-clip-text text-transparent drop-shadow-sm">
                N
            </span>
        </div>

        <h1 class="text-6xl font-black tracking-tighter text-gray-900">
            <span class="bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">Notion</span><span class="bg-gradient-to-r from-indigo-600 to-purple-500 bg-clip-text text-transparent">MMI</span>
        </h1>
    </div>

    <!-- CONTENU CONDITIONNEL -->
    <div class="z-10 text-center max-w-2xl">
        
        @auth
            <!-- CAS 1 : UTILISATEUR CONNECTÉ -->
            <div class="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-700">
                <h2 class="text-2xl font-semibold text-gray-700">
                    Ravi de te revoir, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 font-bold">{{ Auth::user()->name }}</span> 👋
                </h2>
                
                <p class="text-gray-500">
                    Ton espace de travail est prêt. Que veux-tu faire aujourd'hui ?
                </p>

                <!-- Grille de raccourcis rapides -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8 text-left">
                    <!-- Carte 1 -->
                    <a href="/tasks" class="group block p-6 bg-white border border-gray-200 rounded-xl hover:border-indigo-300 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <span class="p-2 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <i class="fa fa-list"></i>
                            </span>
                            <span class="text-xs text-gray-400">&rarr;</span>
                        </div>
                        <h3 class="font-bold text-gray-800">Mes ToDoList</h3>
                        <p class="text-sm text-gray-500 mt-1">Accéder à vos listes de tâches</p>
                    </a>

                    <!-- Carte 2 -->
                    <a href="/notes" class="group block p-6 bg-white border border-gray-200 rounded-xl hover:border-purple-300 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <span class="p-2 bg-purple-50 text-purple-600 rounded-lg group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <i class="fa fa-sticky-note"></i>
                            </span>
                            <span class="text-xs text-gray-400">&rarr;</span>
                        </div>
                        <h3 class="font-bold text-gray-800">Mes Notes</h3>
                        <p class="text-sm text-gray-500 mt-1">Accéder à vos notes</p>
                    </a>
                </div>
            </div>

        @else
            <!-- CAS 2 : INVITÉ (NON CONNECTÉ) -->
            <div class="space-y-6 animate-in zoom-in-95 duration-500">
                <h2 class="text-2xl font-medium text-gray-600">
                    L'outil ultime pour tes idées.
                </h2>
                
                <p class="text-gray-500 leading-relaxed">
                    Centralise tes ressources, organise tes idées sur une plateforme intuitive.
                </p>

                <div class="pt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-700 transition transform hover:-translate-y-1 shadow-lg">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3 bg-white text-gray-900 border border-gray-300 font-semibold rounded-lg hover:bg-gray-50 transition transform hover:-translate-y-1">
                        Créer un compte
                    </a>
                </div>
                
                <div class="pt-8 grid grid-cols-3 gap-8 text-center opacity-60">
                    <div>
                        <i class="fa fa-bolt text-2xl mb-2 text-yellow-500"></i>
                        <p class="text-xs font-bold uppercase tracking-wide">Rapide</p>
                    </div>
                    <div>
                        <i class="fa fa-lock text-2xl mb-2 text-green-500"></i>
                        <p class="text-xs font-bold uppercase tracking-wide">Sécurisé</p>
                    </div>
                    <div>
                        <i class="fa fa-mobile-alt text-2xl mb-2 text-blue-500"></i>
                        <p class="text-xs font-bold uppercase tracking-wide">Mobile</p>
                    </div>
                </div>
            </div>
        @endauth

    </div>
</div>