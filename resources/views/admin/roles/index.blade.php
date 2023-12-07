<x-admin-layout>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.roles.create') }}"
            class="text-white hover:text-gray-900 bg-gray-900 hover:bg-white 
        hover:border border-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:text-white dark:bg-gray-600  dark:hover:border-gray-600 dark:hover:text-gray-400 
        dark:focus:ring-gray-800">
            Nuevo
        </a>
    </div>

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
                @foreach ($roles as $rol)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $rol->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $rol->name }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.roles.edit', $rol) }}"
                                class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fa-solid fa-pen-to-square fa-lg" style="color: #1e3050;"></i>
                            </a>

                            <button type="submit" onclick="DeleteRolIndex()">
                                <i class="fa-solid fa-trash fa-lg" style="color: #1e3050;"></i>
                            </button>

                        </td>
                        <form action="{{ route('admin.roles.destroy', $rol) }}" id="form_delete_rol"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            @push('js')
                                <script>
                                    function DeleteRolIndex() {
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
                                                let form = document.getElementById('form_delete_rol');
                                                form.submit()
                                            }
                                        })
                                    }
                                </script>
                            @endpush
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>