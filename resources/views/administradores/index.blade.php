@include('layouts.sidenav')



<div class="p-4 sm:ml-64">
    <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="my-6">
            <h1 style="font-size: 1.5rem"><p>Administradores</p></h1>
        </div>
        <div class="bg-white shadow-2xl rounded my-6">

            <div class="overflow-x-auto mt-4">
                <table class="min-w-max w-full table-auto rounded-lg" style="margin-top: 15px">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal rounded-lg">
                            <th class="py-3 px-6 text-left">Nombre</th>
                            <th class="py-3 px-6 text-left">Apellido</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($administradores as $administrador)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">{{ $administrador->name }}</td>
                                <td class="py-3 px-6 text-left">{{ $administrador->last_name }}</td>
                                <td class="py-3 px-6 text-left">{{ $administrador->email }}</td>
                                <td class="py-3 px-6 text-center">
                                    <button data-modal-target="update-modal-{{ $administrador->id }}"
                                        data-modal-toggle="update-modal-{{ $administrador->id }}" type="button"
                                        class="text-gray-900 bg-gradient-to-r from-yellow-200 via-yellow-300 to-yellow-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <img src="{{ asset('img/edit.svg') }}"  alt="">
                                    </button>
                                    <button data-modal-target="popup-modal-{{ $administrador->id }}" data-modal-toggle="popup-modal-{{ $administrador->id }}" type="button" class="text-white bg-gradient-to-br from-red-600 to-red-800 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <img src="{{ asset('img/eliminar.svg') }}"  alt="">
                                    </button>
                                </td>
                            </tr>



                            <div id="update-modal-{{ $administrador->id }}"
                                class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                            data-modal-hide="update-modal-{{ $administrador->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Cerrar modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <h3 class="mb-5 text-lg font-normal text-black-500 dark:text-gray-400">
                                                Actualizar Información</h3>
                                            <form
                                                action="{{ route('administradores.actualizar', ['id' => $administrador->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <div class="form-group mt-4 py-6">
                                                    <div class="mb-4">
                                                        <label for="name" class="block mb-2">Nombre:</label>
                                                        <input type="text" id="name" name="name" value="{{ $administrador->name }}" required
                                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="last_name" class="block mb-2">Apellidos:</label>
                                                        <input type="text" id="last_name" name="last_name" value="{{ $administrador->last_name }}" required
                                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="email" class="block mb-2">Email:</label>
                                                        <input type="email" id="email" name="email" value="{{ $administrador->email }}" required
                                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="password" class="block mb-2">Password:</label>
                                                        <input type="password" id="password" name="password" required
                                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                                    </div>

                                                </div>
                                                <button type="submit"
                                                    class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-4">
                                                    Actualizar
                                                </button>
                                            </form>
                                            <button data-modal-hide="update-modal-{{ $administrador->id }}" type="button"
                                                class="text-white bg-gradient-to-br from-gray-700 to-gray-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($administradores as $administrador)
    <div id="popup-modal-{{ $administrador->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal-{{ $administrador->id }}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Seguro de eliminar este coordinador?</h3>
                    <form action="{{ route('administradores.eliminar', $administrador->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="popup-modal-{{ $administrador->id }}" type="submit" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Eliminar</button>
                    </form>
                    <button data-modal-hide="popup-modal-{{ $administrador->id }}" type="button" class="text-white bg-gradient-to-br from-gray-700 to-gray-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.getElementById(modalId).classList.add('flex');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('flex');
        document.getElementById(modalId).classList.add('hidden');
    }
</script>

