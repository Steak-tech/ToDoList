<div>
  <h1 class="text-3xl font-extrabold mb-6">Liste de vos ToDoList</h1>

  <ul class="flex flex-wrap gap-6 align-center justify-between">

    @foreach($todoList as $list)
    <li
      class="
        w-[320px] 
        bg-gray-800 border border-gray-700 rounded-2xl shadow-md
        p-4 flex flex-col gap-3 items-start justify-between
        transition hover:shadow-lg
      "
    >

      <!-- Header -->
       <div class="w-full">
            <div>
                <strong class="text-xl">{{ $list->title }}</strong>
                <p class="text-sm text-gray-400">{{ $list->description }}</p>
            </div>

            <div class="mt-2 w-full overflow-x-visible max-h-[400px]">
                <livewire:task-item :listId="$list->id" :wire:key="'task-item-' . $list->id" />
            </div>

            <div 
                class="
                border-2 border-dashed border-gray-600 h-[50px]
                flex justify-center items-center rounded-xl cursor-pointer
                hover:border-gray-400 hover:bg-gray-700 transition
                w-full
                "
                wire:click="addTask({{ $list->id }})"
            >
                <span class="text-3xl font-bold text-gray-400 select-none">+</span>
            </div>
         </div>
            
      <!-- Bouton Terminer la liste -->

      @if($canFinish[$list->id] ?? false)
      <button
        wire:click="completeList({{ $list->id }})"
        class="
          w-full bg-green-600 text-white font-bold
          py-2 rounded-xl shadow-sm
          hover:bg-green-500 transition
          select-none cursor-pointer
        "
      >
        Terminer la liste ✅
      </button>
      @endif

    </li>
    @endforeach

  </ul>
</div>
