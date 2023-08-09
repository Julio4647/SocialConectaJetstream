<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notas</title>
</head>

<body>
    <div class="container mx-auto" style="margin-top: 15px">
        <form action="{{ route('notes.search') }}" method="POST" class="flex flex-wrap items-center justify-between">
            @csrf
            <div class="w-full sm:w-auto mb-2 sm:mb-0 sm:flex-grow sm:mr-2">
                <div class="flex items-center">
                    <span class="w-full text-purple-900 text-xl sm:w-auto">Plan de contenidos</span>
                    <input name="search" type="text" placeholder="Buscar notas..."
                        class="w-full bg-white border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="w-full  sm:w-auto mb-2 sm:mb-0 sm:mr-2">
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>
            </div>

            <div class="w-full sm:w-auto">
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                    class="w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Nueva Nota
                </button>
            </div>
        </form>




        <div class="card-wrapper mt-4 overflow-y-auto max-h-96">
            <div class="cards-container grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($datos as $item)
                    <div class="card mb-4 bg-white rounded shadow">
                        <div class="card-body">
                            <h5 class="card-title text-lg font-bold mb-2">{{ $item->title }}</h5>
                            <div class="card-text text-gray-700">{{ $item->description }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-hide="authentication-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                    <form class="space-y-6" action="{{ route('notaSave') }}" method="POST">
                        @csrf
                        <div>
                            <label for="titulo"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo</label>
                            <input type="text" name="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                            <input type="text" name="description" id="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>

                        <button
                            type="submit"class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.getElementById('resetButton').addEventListener('click', function() {
            console.log("Reset button clicked"); // Debugging line
            document.querySelector('input[name="search"]').value = '';
            console.log("Search input cleared"); // Debugging line
            document.querySelector('form').submit();
            console.log("Form submitted"); // Debugging line
        });
    </script>
</body>

</html>
