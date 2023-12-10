<<x-admin-layout>

    <form action="{{ route('admin.roles.store') }}" 
            method="post"
            class=" bg-white rounded-lg p-6 shadow-lg">
        @csrf

        <x-validation-errors class=" mb-4">

        </x-validation-errors>

        {{-- logica del nombre --}}
        <div class="mb-6">
            
            <x-label>
                Nombre del rol:
            </x-label>
            
            <x-input name="name" placeholder="Escriba el nombre" value="{{ old('name') }}">

            </x-input>

            @error('name')
                <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
            @enderror
        </div>

        {{-- Logica de los permisos --}}
        <div class=" mb-6">
            <ul>
                @foreach ($permissions as $permission)
                    <li>
                        <label>
                            <x-checkbox name="permissions[]" value="{{ $permission->id }}" 
                                :checked=" in_array($permission->id, old('permissions', [])) "
                                > 
                                
                            </x-checkbox>
                            {{ $permission->name }}
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class=" flex justify-end">
            <x-button>
                Crear Rol
            </x-button>
        </div>
    </form>
    

</x-admin-layout>