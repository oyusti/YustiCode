<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Permisos'
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.permissions.create') }}"
            class="text-white hover:text-gray-900 bg-gray-900 hover:bg-white 
        hover:border border-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:text-white dark:bg-gray-600  dark:hover:border-gray-600 dark:hover:text-gray-400 
        dark:focus:ring-gray-800">
            Nuevo
        </a>
    </x-slot>

    @if($permissions->isEmpty())
        <div class="flex justify-center items-center">
            <div class="bg-white shadow-lg rounded-lg p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
                <div class="flex justify-center items-center">
                    <div class="mr-4">
                        <div class="h-12 w-12 text-white rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-exclamation fa-2x"></i>
                        </div>
                    </div>
                    <div class="flex justify-between items-center w-full">
                        <div class="text-gray-700">
                            <span class="font-bold">No hay registros</span>
                            <span class="block sm:inline">No se encontraron registros</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $permission->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $permission->name }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.permissions.edit', $permission) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    {{-- <i class="fa-solid fa-pen-to-square fa-lg" style="color: #1e3050;"></i> --}}
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</x-admin-layout>