@include('layouts.sidenav')



<div class="p-4 sm:ml-64">
    <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="my-6">
            <h1 style="font-size: 1.5rem">
                <p>AGENCY MANAGER</p>
            </h1>
        </div>
        <div class="bg-white shadow-2xl rounded my-6">
            <div class="overflow-x-auto mt-4">
                @if (isset($userAgencies) && count($userAgencies) > 0)
                    <table class="min-w-max w-full table-auto" style="margin-top: 15px">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Nombre</th>
                                <th class="py-3 px-6 text-center">Apellido</th>
                                <th class="py-3 px-6 text-center">Email</th>
                                <th class="py-3 px-6 text-center">Role</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($userAgencies as $user)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $user->name }}</td>
                                    <td class="py-3 px-6 text-center">{{ $user->last_name }}</td>
                                    <td class="py-3 px-6 text-center">{{ $user->email }}</td>

                                    <td class="py-3 px-6 text-left">
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <button data-modal-target="actualizar-modal-{{ $user->id }}"
                                            data-modal-toggle="actualizar-modal-{{ $user->id }}" type="button"
                                            class="text-gray-900 bg-gradient-to-r from-yellow-200 via-yellow-300 to-yellow-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            <img src="{{ asset('img/edit.svg') }}"  alt="">
                                        </button>
                                        <button data-modal-target="popup-modal-{{ $user->id }}"
                                            data-modal-toggle="popup-modal-{{ $user->id }}" type="button"
                                            class="text-white bg-gradient-to-br from-red-600 to-red-800 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            <img src="{{ asset('img/eliminar.svg') }}"  alt="">
                                        </button>
                                    </td>
                                </tr>



                                <!-- Modal para confirmar la eliminación -->



                                @include('include.modals.delate')
                                @include('include.modals.update')
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay agencias asignadas a coordinadores.</p>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Modal de confirmación de eliminación -->


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
