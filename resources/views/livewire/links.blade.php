<div class="p-6 md:p-10">
    
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-700 tracking-tight">Ressources & Veille</h1>
            <p class="text-gray-400 text-sm mt-1">Vos liens favoris, scrapés automatiquement.</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto mb-12">
        <div class="relative group">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
            
            <div class="relative bg-gray-900 rounded-2xl p-2 flex items-center shadow-xl border border-gray-700/50">
                <div class="pl-4 text-gray-400">
                    <i class="fa fa-link"></i>
                </div>
                <input type="url" 
                       wire:model="newUrl" 
                       wire:keydown.enter="addLink"
                       class="w-full bg-transparent border-none text-gray-700 placeholder-gray-500 focus:ring-0 text-lg"
                       placeholder="Collez une URL (ex: https://youtube.com...) et faites Entrée">
                
                <button wire:click="addLink" 
                        class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-2 rounded-xl font-bold transition flex items-center gap-2">
                    <span wire:loading.remove wire:target="addLink">Ajouter</span>
                    <span wire:loading wire:target="addLink"><i class="fa fa-spinner fa-spin"></i></span>
                </button>
            </div>
            @error('newUrl') <span class="text-red-400 text-sm mt-2 block pl-2">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        @foreach($links as $link)
        <div class="group relative bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-indigo-500/20 hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
            
            <a href="{{ $link->url }}" target="_blank" class="block relative h-48 overflow-hidden bg-gray-900">
                @if($link->image)
                    <img src="{{ $link->image }}" alt="Cover" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-700 flex items-center justify-center">
                        <i class="fa fa-globe text-4xl text-gray-600 group-hover:text-indigo-400 transition"></i>
                    </div>
                @endif
                
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                    <span class="bg-white/90 text-gray-900 px-4 py-2 rounded-full font-bold text-sm shadow-lg transform scale-90 group-hover:scale-100 transition">
                        Visiter <i class="fa fa-external-link-alt ml-1"></i>
                    </span>
                </div>
            </a>

            <div class="p-5 flex flex-col flex-1">
                <div class="flex-1">
                    <a href="{{ $link->url }}" target="_blank" class="block">
                        <h3 class="text-lg font-bold text-gray-100 leading-tight group-hover:text-indigo-400 transition line-clamp-2">
                            {{ $link->title }}
                        </h3>
                    </a>
                    <p class="text-sm text-gray-400 mt-2 line-clamp-3">
                        {{ $link->description ?? 'Aucune description disponible.' }}
                    </p>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-700 flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <i class="fa fa-clock"></i> {{ $link->created_at->diffForHumans() }}
                    </div>
                    
                    <button wire:click="deleteLink({{ $link->id }})" 
                            class="text-gray-500 hover:text-red-400 transition p-2 hover:bg-red-500/10 rounded-lg">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </div>
            </div>

        </div>
        @endforeach

    </div>

    @if($links->isEmpty())
        <div class="text-center py-20">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-800 rounded-full mb-4">
                <i class="fa fa-link text-3xl text-gray-600"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-700">C'est vide par ici</h3>
            <p class="text-gray-400 mt-2">Ajoutez votre premier lien pour voir la magie opérer.</p>
        </div>
    @endif
</div>