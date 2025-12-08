<div class="p-6 md:p-10">

    <style>
        /* On garde les rotations subtiles car c'est sympa, mais sans la font manuscrite */
        .post-it { transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); }
        .post-it:nth-child(odd) { transform: rotate(-1deg); }
        .post-it:nth-child(even) { transform: rotate(1deg); }
        .post-it:hover { transform: scale(1.02) rotate(0deg) !important; z-index: 10; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    </style>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray- tracking-tight">Tableau de Bord</h1>
            <p class="text-gray-400 text-sm mt-1">Épinglez vos idées importantes.</p>
        </div>
    </div>

    @php
        $currentColorClass = $colors[$selectedColor];
        // On extrait juste la couleur de fond (ex: bg-yellow-200) pour l'input
        $bgColor = explode(' ', $currentColorClass)[0];
        $textColor = explode(' ', $currentColorClass)[1];
    @endphp

    <div class="max-w-2xl mx-auto mb-12">
        <div class="relative group rounded-2xl shadow-xl transition-all duration-300 focus-within:ring-4 focus-within:ring-white/20">
            
            <div class="{{ $bgColor }} rounded-2xl p-4 transition-colors duration-300">
                
                <textarea 
                    wire:model="newContent" 
                    wire:keydown.enter.prevent="addNote"
                    rows="2"
                    class="w-full bg-transparent border-none {{ $textColor }} placeholder-gray-500/70 text-lg font-medium focus:ring-0 resize-none"
                    placeholder="Une idée ? Écrivez-la ici..."
                ></textarea>

                <div class="flex items-center justify-between mt-3 pt-3 border-t border-black/5">
                    
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.outside="open = false" 
                                class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/40 hover:bg-white/60 transition text-xs font-bold {{ $textColor }} shadow-sm">
                            <i class="fa fa-palette"></i>
                            <span>Couleur</span>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute top-full left-0 mt-2 p-2 bg-white rounded-xl shadow-2xl border border-gray-100 flex gap-2 z-50 w-max">
                            
                            @foreach($colors as $name => $classes)
                                <button wire:click="$set('selectedColor', '{{ $name }}');" @click="open = false"
                                        class="w-6 h-6 rounded-full border border-gray-200 hover:scale-110 transition shadow-sm {{ explode(' ', $classes)[0] }}">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <button wire:click="addNote" 
                            class="bg-gray-900 text-white px-4 py-1.5 rounded-lg text-sm font-bold shadow-md hover:bg-black transition flex items-center gap-2">
                        Ajouter
                        <i class="fa fa-paper-plane text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @foreach($notes as $note)
            @php
                $colorClass = $colors[$note->color] ?? $colors['yellow'];
            @endphp

            <div class="post-it relative group aspect-square {{ $colorClass }} rounded-3xl shadow-lg p-6 flex flex-col justify-between transition-all duration-300">
                
                <div class="overflow-y-auto custom-scrollbar">
                    <p class="font-bold text-lg leading-snug tracking-tight opacity-90">
                        {{ $note->content }}
                    </p>
                </div>

                <div class="flex justify-between items-end mt-4 pt-4 border-t border-black/5">
                    <span class="text-[10px] font-bold uppercase tracking-wider opacity-50">
                        {{ $note->created_at->diffForHumans() }}
                    </span>

                    <button wire:click="deleteNote({{ $note->id }})"
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-black/5 hover:bg-black/10 text-black/50 hover:text-red-600 transition">
                        <i class="fa fa-trash-alt text-xs"></i>
                    </button>
                </div>

                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-white/20 to-transparent rounded-tr-3xl pointer-events-none"></div>
            </div>
        @endforeach

        @if($notes->isEmpty())
            <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-500">
                <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                    <i class="fa fa-lightbulb text-2xl text-yellow-500"></i>
                </div>
                <p class="font-medium">Aucune note pour le moment.</p>
                <p class="text-sm opacity-60">Utilisez le formulaire ci-dessus pour ajouter une idée.</p>
            </div>
        @endif

    </div>
</div>