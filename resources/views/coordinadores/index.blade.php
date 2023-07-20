@include('layouts.sidenav')

<div class="p-4 sm:ml-64">
    <div class="p-4 dark:border-gray-700 mt-14">
        <div class="my-6">
            <h1 style="font-size: 1.5rem"><p>Coordinadores</p></h1>
        </div>
        <div class="bg-white shadow-md rounded my-6">
            <a href="#" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Agregar Coordinador
            </a>
            <div class="overflow-x-auto">
                @if(isset($coordinadors) && count($coordinadors) > 0)
                    <table class="min-w-max w-full table-auto" style="margin-top: 15px">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">ID</th>
                                <th class="py-3 px-6 text-center">Nombre</th>
                                <th class="py-3 px-6 text-left">Apellido</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($coordinadors as $coordinador)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $coordinador->id }}</td>
                                    <td class="py-3 px-6 text-center">{{ $coordinador->name }}</td>
                                    <td class="py-3 px-6 text-left">{{ $coordinador->last_name }}</td>
                                    <td class="py-3 px-6 text-left">{{ $coordinador->email }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <a href="#" class="text-gray-900 bg-gradient-to-r from-yellow-200 via-yellow-300 to-yellow-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Editar</a>
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="text-white bg-gradient-to-br from-red-600 to-red-800 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay coordinadores registrados.</p>
                @endif
            </div>
        </div>
    </div>
</div>



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
