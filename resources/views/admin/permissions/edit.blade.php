<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Permisos',
        'url' => route('admin.permissions.index')
    ],
    [
        'name' => $permission->name
    ]
]">

    <form action="{{ route('admin.permissions.update', $permission) }}" 
            method="post"
            class=" bg-white rounded-lg p-6 shadow-lg">
        @csrf
        @method('PUT')

        <x-validation-errors class=" mb-4">

        </x-validation-errors>

        <div class="mb-6">
            
            <x-label>
                Nombre del Permiso:
            </x-label>
            
            <x-input name="name" placeholder="Escriba el nombre" value="{{ old('name', $permission->name) }}">

            </x-input>

            @error('name')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class=" flex justify-end">
            <x-danger-button onclick="deletePermission()">
                Eliminar
            </x-danger-button>
            <x-button>
                Actualizar
            </x-button>
        </div>
    </form>

    <form action=" {{ route('admin.permissions.destroy', $permission) }}" id="formDeletePermission" method="POST">
        @csrf
        @method('DELETE')
    </form>

        @push('js')
            <script>
                function deletePermission() {
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
                        if (result.isConfirmed){
                            let form = document.getElementById('formDeletePermission');
                            form.submit();
                        }
                    })
                }
            </script>
        @endpush

</x-admin-layout>