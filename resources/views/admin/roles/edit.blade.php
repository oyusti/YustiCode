<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Home',
        'url' => route('admin.roles.index')
    ],
    [
        'name' => $role->name
    ]
]">

    <form action="{{ route('admin.roles.update', $role) }}" 
            method="post"
            class=" bg-white rounded-lg p-6 shadow-lg">
        @csrf
        @method('PUT')

        <x-validation-errors class=" mb-4">

        </x-validation-errors>

        {{-- div del nombre --}}
        <div class="mb-6">
            
            <x-label>
                Nombre del rol:
            </x-label>
            
            <x-input name="name" placeholder="Escriba el nombre" value="{{ old('name', $role->name) }}">

            </x-input>

            @error('name')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        {{-- div de los permisos --}}
        <div class=" mb-6">
            <ul>
                @foreach ($permissions as $permission)
                    <li>
                        <label>
                            <x-checkbox name="permissions[]" value="{{ $permission->id }}" 
                                :checked=" in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) "
                                > 
                                
                            </x-checkbox>
                            {{ $permission->name }}
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class=" flex justify-end">
            <x-danger-button onclick="deleteRole()">
                Eliminar
            </x-danger-button>
            <x-button>
                Actualizar
            </x-button>
        </div>
    </form>

    <form action=" {{ route('admin.roles.destroy', $role) }}" id="formDeleteRole" method="POST">
        @csrf
        @method('DELETE')
    </form>

        @push('js')
            <script>
                function deleteRole() {
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
                            let form = document.getElementById('formDeleteRole');
                            form.submit();
                        }
                    })
                }
            </script>
        @endpush

</x-admin-layout>