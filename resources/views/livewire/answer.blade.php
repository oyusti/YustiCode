<div class=" pl-16">
    <button wire:click="$toggle('answer_create.open')">
        <i class="fas fa-reply"></i>
        Responder
    </button>

    @if ($answer_create['open'])
        <div class=" flex">
            <figure class=" mr-4">
                <img class=" w-12 h-12 object-cover rounded-full"
                    src="{{ $question->user->profile_photo_url }}">
            </figure>

            <form class=" flex-1" wire:submit="store">
                <textarea wire:model="answer_create.body"
                    class=" block p-2.5 w-full text-gray-900 rounded-lg border border-gray-300
                    focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 mb-2" 
                    rows="3" placeholder="Escribe tu respuesta">
                </textarea>
                <x-input-error for="answer_create.body" />

                <div class=" flex justify-end">
                    <x-danger-button wire:click="$toggle('answer_create.open')">
                        Cancelar
                    </x-danger-button>
        
                    <x-button>
                        Responder
                    </x-button>
                </div>
            </form>
        </div>

    @endif
    
    @if($question->answers()->count() > 0)
        <div class=" mt-4">
            <button class=" font-semibold text-blue-400" wire:click="show_answer()">
                @if($this->cant < $this->question->answers()->count())
                    <i class="fas fa-chevron-down"></i>
                    Mostrar respuestas
                @else
                    <i class="fas fa-chevron-up"></i>
                    Ocultar respuestas
                @endif
            </button>
        </div>
    @endif

    <ul class=" space-y-6 mt-4">
        @foreach ($this->answers as $answer)
        <li wire:key="$answer-{{$answer->id}}">
            <div class=" flex">
                <figure class=" mr-4">
                    <img class=" w-12 h-12 object-cover rounded-full"
                        src="{{ $answer->user->profile_photo_url }}">
                </figure>
                <div class=" flex-1">
                    <p class=" font-semibold">
                        {{ $answer->user->name }}
                        <span class=" text-sm font-normal">
                            {{ $answer->created_at->diffForHumans() }}
                        </span>
                    </p>
                    <p>
                        {{ $answer->body }}
                    </p>
                    <button wire:click="$set('answer_to_answer.id', {{$answer->id}})">
                        <i class="fas fa-reply"></i>
                        Responder
                    </button>
                </div>
            </div>

            @if ($answer->id == $answer_to_answer['id'])
                <div>
                    <figure class=" mr-4">
                        <img class=" w-12 h-12 object-cover rounded-full"
                            src="{{ $question->user->profile_photo_url }}">
                    </figure>
                    <div class="flex-1">
                        <form class=" flex-1" wire:submit="answer_to_answer_store">
                            <textarea wire:model="answer_to_answer.body"
                                class=" block p-2.5 w-full text-gray-900 rounded-lg border border-gray-300
                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                                dark:focus:border-blue-500 mb-2" 
                                rows="3" placeholder="Escribe tu respuesta">
                            </textarea>
                            <x-input-error for="answer_create.body" />
                
                            <div class=" flex justify-end">
                                <x-danger-button wire:click="$set('answer_to_answer.id', null)">
                                    Cancelar
                                </x-danger-button>
                    
                                <x-button>
                                    Responder
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </li>
        @endforeach
    </ul>
    
    
    

</div>
