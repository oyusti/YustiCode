<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Posts',
        'url' => route('admin.posts.index')
    ],
    [
        'name' => $post->title
    ]
]">

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <form action="{{ route('admin.posts.update', $post) }}" 
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class=" mb-6 relative">
            <figure>
                @isset($post->image)
                    <img  class="w-full h-100 aspect-{16/9} object-cover object-center" 
                            src=" {{$post->image}}"
                            alt=""
                            id="imgPreview">
                @endisset
            </figure>
            <div class=" absolute top-16 right-8">
                <label for="file" class="absolute bottom-0 right-0 inline-flex items-center justify-center w-10 h-10 bg-gray-900 rounded-full cursor-pointer">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{2}"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <input type="file" 
                            name="image" 
                            accept="image/*" 
                            id="file" 
                            class="hidden"
                            onchange="previewImage(event, '#imgPreview')">
                </label>
                
            </div>
        </div>


        <h1 class=" text-3xl mb-4">
            Editar Post
        </h1>

        </x-validation-errors class=" mb-4">

        {{-- div para el titulo --}}
        <div class="mb-3">
            <x-label>
                Titulo:
            </x-label>

            <x-input name="title" value="{{ old('title', $post->title) }}">
            </x-input>

            @error('title')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        {{-- div para el slug --}}
        <div class="mb-3">
            <x-label>
                Slug:
            </x-label>

            <x-input name="slug" value="{{ old('slug', $post->slug) }}">
            </x-input>

            @error('slug')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        {{-- div para el select --}}
        <div class="mb-3">
            <x-label>
                Categoria:
            </x-label>

            <x-select name="category_id">
                <option value="">-- Seleccione una categoria --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>

            @error('select')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        {{-- div para el textarea --}}
        <div class="mb-3">
            <x-label>
                Resumen:
            </x-label>

            <x-textarea name="excerpt" rows="3">
                {{ old('excerpt', $post->excerpt) }}
            </x-textarea>

            @error('excerpt')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        {{-- div para el select2 --}}
        <div class="mb-4">
            <x-label>
                Etiquetas:
            </x-label>

            <select name="tags[]" id="tags" class="tag-multiple w-full" multiple>
                @foreach ($post->tags as $tag)
                    <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
                @endforeach
            </select>
            

            @error('tags')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

            {{-- div para el body --}}
            <div class="mb-3">
                <x-label>
                    Cuerpo del post:
                </x-label>

                <div class="ckeditor">
                    <x-textarea id="editor" name="body" rows="8">
                        {{ old('body', $post->body) }}
                    </x-textarea>
                </div>

                @error('body')
                    <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            {{-- div para el checkbox --}}
            <div class=" mb-4">

                <input type="hidden" name="published" value="0">

                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="published" value="1" class="sr-only peer"
                        @checked(old('published', $post->published) == 1)>
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publicar</span>
                </label>
            </div>


            {{-- div para el boton --}}
            <div class="flex justify-end">

                <x-danger-button onclick="deletePost()">
                    Eliminar
                </x-danger-button>

                <x-button>
                    Actualizar
                </x-button>
            </div>

    </form>

    {{-- Formulario para eliminar --}}

    <form action=" {{ route('admin.posts.destroy', $post) }}" id="formDeletePost" method="POST">
        @csrf
        @method('DELETE')
    </form>

    @push('js')
        {{-- script para previsualizar una imagen --}}
        <script>
            function previewImage(event, id) {
                if (event.target.files.length > 0) {
                    let src = URL.createObjectURL(event.target.files[0]);
                    let preview = document.querySelector(id);
                    preview.src = src;
                    preview.style.display = "block";
                }
            }

           /*  script para el sweetalert */
        
            function deletePost() {
                event.preventDefault();
                //Modal de confirmacion
                Swal.fire({
                    title: 'Esta usted seguro?',
                    text: "Usted no podra revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('formDeletePost');
                        form.submit();
                    }
                })
            }
        </script>
            
        {{-- script para el select2 --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        {{-- script para el select2 de etiquetas para llenar con ajax --}}
        <script>
            $(document).ready(function() {
                $('.tag-multiple').select2({
                    tags:true,
                    tokenSeparators:[',',' '],
                    ajax:{
                        url:"{{ route('api.tags.index') }}",
                        dataType:'json',
                        delay:250,
                        data:function(params){
                            return{
                                term: params.term
                            }
                        },
                        processResults:function(data){
                            return{
                                results:data
                            }
                        },
                    }
                });
            });
        </script>

        {{-- script para el editor de texto --}}
        <script>
            ClassicEditor
            .create( document.querySelector( '#editor' ), {
                simpleUpload: {
                    // The URL that the images are uploaded to.
                    uploadUrl: '{{ route('image.upload') }}',

                    // Enable the XMLHttpRequest.withCredentials property.
                    withCredentials: true,

                    // Headers sent along with the XMLHttpRequest to the upload server.
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                }
            } )
            .catch( error => {
            console.error( error );
        } );
        </script>
            
            
    @endpush



</x-admin-layout>
