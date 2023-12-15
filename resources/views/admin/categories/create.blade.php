<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Categorias',
        'url' => route('admin.categories.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]">

    <form action="{{ route('admin.categories.store') }}" 
            method="post"
            class=" bg-white rounded-lg p-6 shadow-lg">
        @csrf

        <x-validation-errors class=" mb-4">

        </x-validation-errors>

        <div class="mb-6">
            
            <x-label>
                Nombre:
            </x-label>
            
            <x-input name="name" placeholder="Escriba su nombre">

            </x-input>

            @error('name')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class=" flex justify-end">
            <x-button>
                Crear Categoria
            </x-button>
        </div>
    </form>
    

</x-admin-layout>