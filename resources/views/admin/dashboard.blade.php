<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home'
    ]
]">

<div class=" grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class=" bg-white rounded-lg shadow-lg px-6 py-4">
        <div class=" flex items-center">
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            </button>
            <div class="flex flex-col ml-4">
                <h2 class="text-lg font-semibold">
                    Bienvenido {{ Auth::user()->name }}
                </h2>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class=" text-sm hover:text-blue-500" type="submit">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
        
    </div>

    <div class=" bg-white rounded-lg shadow-lg p-6 flex justify-center items-center ">
        <h2 class=" text-xl font-semibold uppercase"">
            Yusti Code
        </h2>
    </div>

</div>

</x-admin-layout>