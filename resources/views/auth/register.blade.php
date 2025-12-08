@extends('components.layouts.guest')

@section('content')
<div class="relative min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 overflow-hidden">

    <div class="absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiIHZpZXdCb3g9IjAgMCA0IDQiPjxwYXRoIGZpbGw9IiM5OTkiIGZpbGwtb3BhY2l0eT0iLjEiIGQ9Ik0xIDNoMXYxSDFVLTFtMSAwSDJ2MUgxWiIvPjwvc3ZnPg==')] opacity-20 mix-blend-soft-light"></div>
        
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-purple-400/30 rounded-full blur-3xl animate-[spin_20s_linear_infinite]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-indigo-500/30 rounded-full blur-3xl animate-[bounce_10s_infinite]"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-blue-300/20 rounded-full blur-3xl animate-pulse"></div>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-6">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg rotate-3 mb-4 group hover:rotate-0 transition-transform duration-300">
            <span class="text-xl font-bold text-white">N</span>
        </div>
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
            Inscription
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Rejoignez l'aventure <span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">NotionMMI</span>
        </p>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white/60 backdrop-blur-xl border border-white/50 py-8 px-4 shadow-2xl sm:rounded-2xl sm:px-10 relative">
            
            @if ($errors->any())
                <div class="mb-6 bg-red-50/80 border border-red-200 text-red-600 rounded-lg p-4 text-sm flex items-start gap-3">
                    <i class="fa fa-exclamation-circle mt-0.5"></i>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                               class="block w-full pl-10 pr-3 py-2.5 bg-white/50 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" 
                               placeholder="Jean Dupont">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse Email</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa fa-envelope text-gray-400 text-sm"></i>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                               class="block w-full pl-10 pr-3 py-2.5 bg-white/50 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" 
                               placeholder="vous@exemple.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa fa-lock text-gray-400 text-sm"></i>
                        </div>
                        <input type="password" id="password" name="password" required autocomplete="new-password"
                               class="block w-full pl-10 pr-3 py-2.5 bg-white/50 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" 
                               placeholder="••••••••">
                    </div>
                </div>

                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa fa-shield-alt text-gray-400 text-sm"></i>
                        </div>
                        <input type="password" id="password-confirm" name="password_confirmation" required autocomplete="new-password"
                               class="block w-full pl-10 pr-3 py-2.5 bg-white/50 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all" 
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fa fa-user-plus text-indigo-200 group-hover:text-white transition-colors"></i>
                        </span>
                        Créer mon compte
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200/60"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-transparent text-gray-500">
                            Déjà inscrit ?
                        </span>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                        Se connecter à mon espace &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection