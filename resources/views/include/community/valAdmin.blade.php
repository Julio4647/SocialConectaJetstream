
                            @foreach ($userCom as $user)


                                <tr>
                                    <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                                    <td class="py-3 px-6 text-left">{{ $user->last_name }}</td>
                                    <td class="py-3 px-6 text-left">
                                        @if ($user->coordinators->count() > 0)
                                            {{ $user->coordinators->first()->name }}
                                            {{ $user->coordinators->first()->last_name }}
                                        @else
                                            No Asignado
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                                    <td class="py-3 px-6 text-left">
                                        @foreach ($user->roles as $role)
                                            {{ $role->name }} <!-- Muestra los roles de cada usuario -->

                                          @endforeach
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <button data-modal-target="actualizar-modal-{{ $user->id }}"
                                            data-modal-toggle="actualizar-modal-{{ $user->id }}" type="button"
                                            class="text-gray-900 bg-gradient-to-r from-yellow-200 via-yellow-300 to-yellow-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            <img src="{{ asset('img/edit.svg') }}" alt="">
                                        </button>
                                        <button data-modal-target="update-modal-{{ $user->id }}"
                                            data-modal-toggle="update-modal-{{ $user->id }}" type="button"
                                            class="text-white bg-gradient-to-br from-blue-500 to-blue-800 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            <img src="{{ asset('img/usuario.svg') }}" alt="">
                                        </button>
                                        <button data-modal-target="popup-modal-{{ $user->id }}"
                                            data-modal-toggle="popup-modal-{{ $user->id }}" type="button"
                                            class="text-white bg-gradient-to-br from-red-600 to-red-800 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            <img src="{{ asset('img/eliminar.svg') }}" alt="">
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
                                                    action="{{ route('user_cordinator.update', ['userId' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group mt-4 py-6">
                                                        <select id="coordinador_id"
                                                            class="rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('coordinador_id') is-invalid @enderror"
                                                            name="coordinador_id" required>
                                                            <option value="">Select Coordinator</option>
                                                            @foreach ($coordinators as $coordinator)
                                                                <option value="{{ $coordinator->id }}">
                                                                    {{ $coordinator->name }}</option>

                                                            @endforeach
                                                        </select>
                                                        @error('coordinador_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <button type="submit"
                                                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-4">
                                                        Actualizar
                                                    </button>
                                                </form>
                                                <button data-modal-hide="update-modal-{{ $user->id }}"
                                                    type="button"
                                                    class="text-white bg-gradient-to-br from-gray-700 to-gray-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                @endforeach

