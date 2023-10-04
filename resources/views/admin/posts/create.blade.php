<x-admin-layout>

    <h1 class=" text-3xl mb-4">
        Nuevo Post
    </h1>

    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf

        <x-validation-errors class=" mb-4">

        </x-validation-errors>

        {{-- div para el titulo --}}
        <div class="mb-3">
            <x-label>
                Titulo:
            </x-label>

            <x-input name="title" placeholder="Escriba el titulo del post" value="{{ old('title') }}">
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

            <x-input name="slug" placeholder="Escriba el slug del post" value="{{ old('slug') }}">
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
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>

            @error('select')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        {{-- div para el boton --}}
        <div class=" flex justify-end">
            <x-button>
                Crear Post
            </x-button>
        </div>

    </form>

</x-admin-layout>