<div>
    <ul>
        @foreach($tasks as $task)
            <li 
                wire:click="toggleComplete({{ $task->id }})"
                class="
                    cursor-pointer select-none
                    px-4 py-2 rounded-lg font-medium
                    transition transform hover:scale-[1.02]
                    mb-2
                    {{ $task->is_completed ? 'bg-green-300 text-green-700 border border-green-500' : 'bg-gray-300 text-black' }}
                "
            >
                <span class="mr-2 text-xl">
                    {{ $task->is_completed ? '✔️' : '❌' }}
                </span>
                {{ $task->title }}
            </li>
        @endforeach
    </ul>
</div>
