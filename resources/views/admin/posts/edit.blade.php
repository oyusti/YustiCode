<x-admin-layout>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST">

        @csrf
        @method('PUT')

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
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
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

        {{-- div para el body --}}
        <div class="mb-3">
            <x-label>
                Cuerpo del post:
            </x-label>

            <x-textarea name="body" rows="8">
                {{ old('body', $post->body) }}
            </x-textarea>

            @error('body')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        




    
    </form>

</x-admin-layout>