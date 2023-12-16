<x-app-layout>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">

        <div class="mb-4 mt-4">
            @foreach ($post->tags as $tag)
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>

        <h1 class=" text-center text-5xl font-semibold mb-4">
            {{ $post->title }}
        </h1>

        <hr class=" mt-1 mb-1">

        <div class=" mt-1 mb-1 flex items-center">
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                <img class="h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            </button>
            <div class=" flex flex-col ml-4">
                <span class=" text-sm">
                    {{ $post->user->name }}
                </span>
                <span class=" text-sm">
                    {{ $post->published_at->format('d/m/Y')}}
                </span>
            </div>
        </div>

        <figure>
            <img class="w-full aspect-[3/1] object-cover object-center"
                src="{{ $post->image }}" alt="{{ $post->title }}">
        </figure>

        <div class=" mt-4 mb-4">
            {!! $post->body !!}
        </div>

    </section>

</x-app-layout>