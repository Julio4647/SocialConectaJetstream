@include('layouts.sidenav')

<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4  dark:border-gray-700 mt-14">
                        <a href="{{ route('administradores') }}" class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Regresar</a>
                        <h2 style="margin-top: 15px">Agregar Administrador</h2>
                        <form action="{{ route('administradores.guardar') }}" method="POST" class="w-full max-w-sm mx-auto">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                                <input type="text" id="name" name="name" required
                                       class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                                <input type="text" id="last_name" name="last_name" required
                                       class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                <input type="email" id="email" name="email" required
                                       class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña:</label>
                                <input type="password" id="password" name="password" required
                                       class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>



                            <div class="flex items-center justify-center">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Guardar
                                </button>
                            </div>
                        </form>

            </div>
        </div>
    </div>
</x-app-layout>

