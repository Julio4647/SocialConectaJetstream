@include('layouts.sidenav')



<div class="p-4 sm:ml-64">
    <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="my-6">
            <h1 style="font-size: 1.5rem">
                <p>COORDINADORES</p>
            </h1>
        </div>
        <a href="{{ route('coordinador.create') }}"
                class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Asignar Agency a Coordinador
            </a>
        <div class="bg-white shadow-2xl rounded my-6">
            <div class="overflow-x-auto mt-4">
                @if (isset($userAgencies) && count($userAgencies) > 0)
                    <table class="min-w-max w-full table-auto" style="margin-top: 15px">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Nombre</th>
                                <th class="py-3 px-6 text-center">Apellido</th>
                                <th class="py-3 px-6 text-center">Email</th>
                                <th class="py-3 px-6 text-center">Agency Manager</th>
                                <th class="py-3 px-6 text-center">Role</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($userAgencies as $user)
                            @if ($user->agency->first() && $user->agency->first()->id === $coordinatorId)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $user->name }}</td>
                                    <td class="py-3 px-6 text-center">{{ $user->last_name }}</td>
                                    <td class="py-3 px-6 text-center">{{ $user->email }}</td>
                                    <td class="py-3 px-6 text-left">
                                        @if ($user->agency->count() > 0)
                                            {{ $user->agency->first()->name }}
                                            {{ $user->agency->first()->last_name }}
                                        @else
                                            No Asignado
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }}
                                        @endforeach
                                    </td>
                                </tr>













                                <!-- Modal para confirmar la eliminación -->
                                @include('include.modals.delate')

                                @include('include.modals.update')




                                <div id="update-modal-{{ $user->id }}"
                                    class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                data-modal-hide="update-modal-{{ $user->id }}">
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
                                                    Actualizar Coordinador</h3>
                                                <form
                                                    action="{{ route('user_agency.update', ['coordinatorId' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group mt-4 py-6">
                                                        <select id="agency_id" class="form-control @error('agency_id') is-invalid @enderror" name="agency_id" required>
                                                            <option value="">Select Coordinador</option>
                                                            @foreach ($agencies as $agency)
                                                                <option value="{{ $agency->id }}">{{ $agency->name }} {{ $agency->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('agency_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <button type="submit"
                                                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-4">
                                                        Actualizar
                                                    </button>
                                                </form>
                                                <button data-modal-hide="update-modal-{{ $user->id }}" type="button"
                                                    class="text-white bg-gradient-to-br from-gray-700 to-gray-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                             @elseif ($roles->contains('admin'))

                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-center">{{ $user->name }}</td>
                                    <td class="py-3 px-6 text-center">{{ $user->last_name }}</td>
                                    <td class="py-3 px-6 text-center">{{ $user->email }}</td>
                                    <td class="py-3 px-6 text-left">
                                        @if ($user->agency->count() > 0)
                                            {{ $user->agency->first()->name }} {{ $user->agency->first()->last_name }}
                                        @else
                                            No Asignado
                                        @endif
                                    </td>
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
                                        <button data-modal-target="update-modal-{{ $user->id }}"
                                            data-modal-toggle="update-modal-{{ $user->id }}" type="button"
                                            class="text-white bg-gradient-to-br from-blue-500 to-blue-800 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            <img src="{{ asset('img/usuario.svg') }}"  alt="">
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




                                <div id="update-modal-{{ $user->id }}"
                                    class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                data-modal-hide="update-modal-{{ $user->id }}">
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
                                                    Actualizar Coordinador</h3>
                                                <form
                                                    action="{{ route('user_agency.update', ['coordinatorId' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group mt-4 py-6">
                                                        <select id="agency_id" class="rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('agency_id') is-invalid @enderror" name="agency_id" required>
                                                            <option value="">Seleccionar Coordinador</option>
                                                            @foreach ($agencies as $agency)
                                                                <option value="{{ $agency->id }}">{{ $agency->name }} {{ $agency->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('agency_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <button type="submit"
                                                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-4">
                                                        Actualizar
                                                    </button>
                                                </form>
                                                <button data-modal-hide="update-modal-{{ $user->id }}" type="button"
                                                    class="text-white bg-gradient-to-br from-gray-700 to-gray-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
