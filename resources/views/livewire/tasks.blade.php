<div class="p-6 md:p-10 relative">
  
  @if (session()->has('message'))
      <div 
           x-data="{ show: true }" 
           x-show="show" 
           x-init="setTimeout(() => show = false, 3000)"
           class="mb-6 bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded-xl flex items-center justify-between shadow-lg shadow-green-500/10 transition-all duration-500"
      >
          <div class="flex items-center">
              <i class="fa fa-check-circle mr-2 text-xl"></i>
              <span class="font-bold">{{ session('message') }}</span>
          </div>
          
          <button @click="show = false" class="text-green-700 hover:text-green-900">
              <i class="fa fa-times"></i>
          </button>
      </div>
  @endif
<div class="p-6 md:p-10 relative"> <h1 class="text-3xl font-extrabold mb-6 text-gray-700">Liste de vos To do list</h1>


  <ul class="flex flex-wrap gap-6 align-center justify-start"> 
    @if($todoList->isEmpty())
      <li class="w-full flex flex-col items-center justify-center p-10 border-2 border-dashed border-gray-600 rounded-2xl bg-gray-800/50">
        <p class="text-white text-center mb-4">
          Vous n'avez pas encore de ToDoList. Créez-en une pour commencer à organiser vos tâches !
        </p>
        <button
          wire:click="openCreateModal"
          class="
            bg-indigo-600 text-white font-bold
            py-2 px-6 rounded-xl shadow-lg shadow-indigo-500/30
            hover:bg-indigo-500 hover:scale-105 transition transform
            select-none cursor-pointer
          "
        >
          Créer une ToDoList
        </button>
      </li>
    @endif

    @foreach($todoList as $list)
    <li class="w-[320px] bg-gray-800 border border-gray-700 rounded-2xl shadow-md p-4 flex flex-col gap-3 items-start justify-between transition hover:shadow-lg hover:border-gray-500">
        <div class="w-full">
            <div>
                <strong class="text-xl text-white">{{ $list->title }}</strong>
                <p class="text-sm text-gray-400">{{ $list->description }}</p>
            </div>

            <div class="mt-2 w-full overflow-x-visible max-h-[400px]">
                <livewire:task-item :listId="$list->id" :wire:key="'task-item-' . $list->id" />
            </div>

            <div 
                class="mt-3 border-2 border-dashed border-gray-600 h-[50px] flex justify-center items-center rounded-xl cursor-pointer hover:border-gray-400 hover:bg-gray-700 transition w-full"
                wire:click="openItemModal({{ $list->id }})"
            >
                <span class="text-3xl font-bold text-gray-400 select-none">+</span>
            </div>
         </div>
            
        @if($canFinish[$list->id] ?? false)
        <button wire:click="completeList({{ $list->id }})" class="w-full bg-green-600 text-white font-bold py-2 rounded-xl shadow-sm hover:bg-green-500 transition select-none cursor-pointer">
            Terminer la liste ✅
        </button>
        @endif
    </li>
    @endforeach
    
    @if(!$todoList->isEmpty())
        <li class="w-[320px] h-auto min-h-[200px] border-2 border-dashed border-gray-600 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:bg-gray-800/50 hover:border-gray-400 transition group"
            wire:click="openCreateModal">
            <div class="w-16 h-16 rounded-full bg-gray-700 flex items-center justify-center group-hover:bg-indigo-600 transition">
                <i class="fa fa-plus text-2xl text-white"></i>
            </div>
            <p class="mt-3 text-gray-400 font-medium group-hover:text-white">Nouvelle Liste</p>
        </li>
    @endif

  </ul>

  @if($showCreateModal)
  <div class="fixed inset-0 z-50 flex items-center justify-center px-4"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0">
    
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeCreateModal"></div>

    <div class="relative bg-gray-900 border border-gray-700 rounded-2xl shadow-2xl w-full max-w-md p-6 transform transition-all">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-white">Nouvelle ToDoList</h2>
            <p class="text-gray-400 text-sm">Donnez un titre à votre projet.</p>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Titre</label>
                <input type="text" 
                       wire:model="newTitle" 
                       class="w-full bg-gray-800 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-500"
                       placeholder="Ex: Projet Portfolio..." 
                       autofocus>
                @error('newTitle') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Description (Optionnel)</label>
                <textarea 
                       wire:model="newDescription" 
                       class="w-full bg-gray-800 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-500 resize-none h-24"
                       placeholder="Petite note pour ce projet..."></textarea>
                @error('newDescription') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <button wire:click="closeCreateModal" 
                    class="px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg transition">
                Annuler
            </button>
            <button wire:click="createTodoList" 
                    class="px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-500 shadow-lg shadow-indigo-500/20 transition flex items-center gap-2">
                <span wire:loading.remove wire:target="createTodoList">Créer</span>
                <span wire:loading wire:target="createTodoList"><i class="fa fa-spinner fa-spin"></i></span>
            </button>
        </div>

    </div>
  </div>
  @endif

  @if($showItemModal)
  <div class="fixed inset-0 z-50 flex items-center justify-center px-4"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0">
    
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="closeItemModal"></div>

    <div class="relative bg-gray-900 border border-gray-700 rounded-2xl shadow-2xl w-full max-w-md p-6 transform transition-all">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-white">Nouvelle Tâche</h2>
            <p class="text-gray-400 text-sm">Ajoutez une tâche à votre liste.</p>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Titre de la tâche</label>
                <input type="text" 
                       wire:model="newItemTitle" 
                       class="w-full bg-gray-800 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-500"
                       placeholder="Ex: Terminer le projet..." 
                       autofocus>
                @error('newItemTitle') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <button wire:click="closeItemModal" 
                    class="px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg transition">
                Annuler
            </button>
            <button wire:click="addTaskItem" 
                    class="px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-500 shadow-lg shadow-indigo-500/20 transition flex items-center gap-2">
                <span wire:loading.remove wire:target="addTaskItem">Ajouter</span>
                <span wire:loading
  @endif


</div>