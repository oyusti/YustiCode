<div class=" pl-16">
    <button wire:click="$toggle('question_create.open')">
        <i class="fas fa-reply"></i>
        Responder
    </button>

    @if ($question_create['open'])
    <div class=" flex">
        <figure class=" mr-4">
            <img class=" w-12 h-12 object-cover rounded-full"
                src="{{ $question->user->profile_photo_url }}">
        </figure>

        <form class=" flex-1">
            <textarea
                class=" block p-2.5 w-full text-gray-900 rounded-lg border border-gray-300
                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                dark:focus:border-blue-500 mb-2" 
                rows="3" placeholder="Escribe tu respuesta">
            </textarea>
            {{-- <x-input-error for="question_edit.body" /> --}}

            <div class=" flex justify-end">
                <x-danger-button wire:click="$toggle('question_create.open')">
                    Cancelar
                </x-danger-button>
    
                <x-button>
                    Responder
                </x-button>
            </div>
        </form>

    @else
        
    @endif

</div>
