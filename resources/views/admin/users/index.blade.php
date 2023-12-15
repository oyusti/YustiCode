<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Usuarios'
    ]
]">

    @if($users->isEmpty())
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
                            Correo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.users.edit', $user) }}"
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

    <div class="mt-4">
        {{ $users->links() }}
    </div>

</x-admin-layout>