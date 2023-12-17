<x-app-layout>

    <figure class=" mb-12">
        <img class="w-full aspect-[3/1] object-cover object-center" src="{{ asset('img/mesa_programacion.jpg') }}"
            alt="Cover">
    </figure>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">

        <h1 class=" text-3xl font-semibold text-center mb-4">
            Lista de Posts
        </h1>

        <div class=" grid grid-cols-4 gap-8">

            <div class=" col-span-1">

                <form action="{{ route('home') }}">

                    <div class=" mb-6">
                        <p class=" text-lg font-semibold">Ordenar por:</p>
                        
                        <select class=" block w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" 
                                name="order">
                            <option value="">Seleccionar</option>
                            <option value="new" @selected(request('order') == 'new')>Mas recientes</option>
                            <option value="old" @selected(request('order') == 'old')>Mas antiguos</option>
                        </select>
                    </div>

                    <div class=" mb-6">
                        <p class=" text-lg font-semibold mb-2">Categorias: </p>
                        
                        @foreach ($categories as $category)
                            <label class=" flex items-center mb-2">
                                <x-checkbox name="category[]" value="{{ $category->id }}" :checked="in_array($category->id, request('category') ?? [])"/>
                                <span class=" ml-2"> {{ $category->name }} </span>
                            </label>
                        @endforeach
                    </div>

                    <div>
                        <x-button>
                            Aplicar Filtros
                        </x-button>
                    </div>

                </form>

            </div>

            <div class=" col-span-3">
                <div class=" space-y-4">
                    @foreach ($posts as $post)
                        <article class="grid grid-cols-2 gap-6">
    
                            <figure>
                                <img class="w-full aspect-[16/9] object-cover object-center"
                                    src="{{ $post->image }}" alt="{{ $post->title }}">
                            </figure>
    
                            <div>
                                <h1 class=" text-xl font-semibold">
                                    {{-- <a href="{{ route('posts.show', $post) }}"> --}}
                                        {{ $post->title }}
                                {{--  </a> --}}
                                </h1>
    
                                <hr class=" mt-1 mb-1">
    
                                <div class=" mt-1 mb-1">
    
                                    @foreach ($post->tags as $tag)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                            {{ $tag->name }}
                                        </span>
                                    {{-- <a href="{{ route('posts.tag', $tag) }}" class=" inline-block bg-{{ $tag->color }}-600 rounded-full px-3 py-1 text-sm text-white">
                                        {{ $tag->name }}
                                    </a> --}}
                                    @endforeach
    
                                </div>
    
                                <div class=" mb-2">
    
                                    <p class=" text-sm">
                                        <strong>Fecha de Publicacion:</strong> {{ $post->published_at->format('d/m/Y')}}
                                    </p>
    
                                    <p class=" text-sm">
                                        <strong>Autor:</strong> {{ $post->user->name }}
                                    </p>
    
                                </div>
    
    
                                {{-- <p class=" text-sm text-gray-500">
                                    &bull; {{ $post->created_at->format('d/m/Y') }}
                                </p> --}}
                                
                                <p>
                                    {{-- {{ Str::limit($post->body, 200)}} --}}
                                    {{ $post->excerpt }}
                                </p>
        
    
                                <div class=" mt-4 flex justify-end">
                                    <a href="{{ route('posts.show', $post) }}" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        Leer mas
                                    </a>
                                </div>
    
                            </div>
    
                            
    
                        </article>
                    @endforeach
                </div>
    
                <div class=" mt-8">
                    {{ $posts->links() }}
                </div>
            </div>

        </div>

            

    </section>

    

</x-app-layout>
