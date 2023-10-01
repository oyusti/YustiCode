<x-admin-layout>

    <form action="{{ route('admin.categories.update', $category) }}" 
            method="post"
            class=" bg-white rounded-lg p-6 shadow-lg">
        @csrf
        @method('PUT')

        <x-validation-errors class=" mb-4">

        </x-validation-errors>

        <div class="mb-6">
            
            <x-label>
                Nombre:
            </x-label>
            
            <x-input name="name" placeholder="Escriba el nombre" value="{{ $category->name }}">

            </x-input>

            @error('name')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class=" flex justify-end">
            <x-danger-button onclick="deleteCategory()">
                Eliminar
            </x-danger-button>

            <x-button>
                Actualizar
            </x-button>
        </div>
    </form>

    <form   action=" {{ route('admin.categories.destroy', $category) }}" 
            id="formDeleteCategory" 
            method="POST">
        @csrf
        @method('DELETE')

        @push('js')
            <script>
                function deleteCategory(){
                    let form = document.getElementById('formDeleteCategory');
                    form.submit();
                }
            </script>
        @endpush
        
    </form>

</x-admin-layout>