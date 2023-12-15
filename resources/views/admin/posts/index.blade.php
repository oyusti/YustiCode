<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Posts'
    ]
]">

    <x-slot name="action">
        <a href="{{ route('admin.posts.create') }}"
            class="text-white hover:text-gray-900 bg-gray-900 hover:bg-white 
        hover:border border-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:text-white dark:bg-gray-600  dark:hover:border-gray-600 dark:hover:text-gray-400 
        dark:focus:ring-gray-800">
            Nuevo
        </a>
    </x-slot>


    <ul class=" space-y-8">
        @foreach ($posts as $post)
            <li class=" grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <a href="{{ route('admin.posts.edit', $post) }}">
                        <img class=" aspect-[16/9] object-cover object-center w-full" src="{{ $post->image }}" alt="">{{-- image is an accessor, the real name in database is image_path--}}
                    </a>
                </div>
                <div>
                    <a href="{{ route('admin.posts.edit', $post) }}">
                        <h1 class=" text-xl font-semibold">
                            {{ $post->title }}
                        </h1>
                    </a>

                    <hr class=" mt-1 mb-2">

                    <span @class([
                            'bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300' => $post->published,
                            'bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300'  => !$post->published,
                        ])>
                        {{ $post->published ? 'Published' : 'Borrador' }}
                    </span>

                    <p class=" text-gray-700 mt-2">
                        {{ Str::limit($post->body, 200)}}
                    </p>

                    <div class=" mt-4 flex justify-end">
                        <a href="{{ route('admin.posts.edit', $post) }}" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Editar
                        </a>
                        {{-- <a href="{{ route('posts.show', $post) }}" class=" text-sm font-medium text-blue-600 hover:text-blue-500">
                            Ver
                        </a> --}}
                </div>
            </li>
        @endforeach
    </ul>

    <div class=" mt-8">
        {{ $posts->links() }}
    </div>

</x-admin-layout>