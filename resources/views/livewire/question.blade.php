<div>
    <div class="mb-4 mt-4 flex">

        <figure class=" mr-4">
            <img class=" w-12 h-12 object-cover rounded-full" src="{{ Auth::user()->profile_photo_url }}">
        </figure>

        <div class=" flex-1 ">
            <form wire:submit="store">

                <textarea wire:model="message"
                    class=" block p-2.5 w-full text-gray-900 rounded-lg border border-gray-300
                    focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 mb-2"
                    rows="3" placeholder="Escriba su comentario">
                </textarea>
                <x-input-error for="message" />
                {{-- <div>@error('message') {{ $message }} @enderror</div> --}}

                <div class=" flex justify-end">
                    <x-button>
                        Comentar
                    </x-button>
                </div>
            </form>

        </div>

    </div>

    <p class=" text-lg font-semibold mt-6 mb-4">
        Comentarios:
    </p>

    <ul class=" space-y-6">
        @foreach ($questions as $question)
            <li wire:key="question-{{$question->id}}">
                <div class=" flex">
                    <figure class=" mr-4">
                        <img class=" w-12 h-12 object-cover rounded-full"
                            src="{{ $question->user->profile_photo_url }}">
                    </figure>

                    <div class=" flex-1">
                        <p class=" font-semibold">
                            {{ $question->user->name }}
                            <span class=" text-sm font-normal">
                                {{ $question->created_at->diffForHumans() }}
                            </span>
                        </p>
                        @if ($question->id == $question_edit['id'])
                            <form wire:submit="update">
                                <textarea wire:model="question_edit.body"
                                    class=" block p-2.5 w-full text-gray-900 rounded-lg border border-gray-300
                                    focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                                    dark:focus:border-blue-500 mb-2"
                                    rows="3">
                                </textarea>
                                <x-input-error for="question_edit.body" />
            
                                <div class=" flex justify-end">
                                    <x-danger-button wire:click="cancel" >
                                        Cancelar
                                    </x-danger-button>
                        
                                    <x-button>
                                        Actualizar
                                    </x-button>
                                </div>
                            </form>
                        @else
                            <p>
                                {{ $question->body }}
                            </p>
                        @endif
                            
                    </div>

                    <div>
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <i class=" fas fa-ellipsis-v"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                
                                <x-dropdown-link wire:click="edit({{$question->id}})" class="cursor-pointer">
                                    Editar
                                </x-dropdown-link>
                        
                                <x-dropdown-link wire:click="destroy({{$question->id}})" class="cursor-pointer">
                                    Eliminar
                                </x-dropdown-link>
                                
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                @livewire('answer', compact('question'), key('answer-'.$question->id))
            </li>
        @endforeach
    </ul>


</div>
