<div>
    <div class="mb-4 mt-4 flex">

        <figure class=" mr-4">
            <img class=" w-12 h-12 object-cover rounded-full" src="{{ Auth::user()->profile_photo_url }}">
        </figure>

        <div class=" flex-1 ">
            <form action="">
                <textarea
                    class=" block p-2.5 w-full text-gray-900 rounded-lg border border-gray-300
                    focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 mb-2"  name="" id="" rows="3" placeholder="Escriba su comentario">
                </textarea>
                <div class=" flex justify-end">
                    <x-button>
                        Comentar
                    </x-button>
                </div>
            </form>
        </div>

    </div>


</div>
