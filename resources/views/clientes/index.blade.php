@include('layouts.sidenav')


<div class="p-4 sm:ml-64">
    <div class="p-4 dark:border-gray-700 mt-14">
        <div class="my-6">
            <h1 style="font-size: 1.5rem">
                <p>CLIENTES</p>
            </h1>
        </div>
        <a href="{{ route('clients.create') }}" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
            Agregar Cliente
        </a>
        <div class="bg-white shadow-2xl rounded my-6">
            <div class="overflow-x-auto">
                <table class="min-w-max w-full table-auto" style="margin-top: 15px">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-center">ID</th>
                            <th class="py-3 px-6 text-center">Community</th>
                            <th class="py-3 px-6 text-center">Nombre</th>
                            <th class="py-3 px-6 text-center">Apellido</th>
                            <th class="py-3 px-6 text-center">Telefono</th>
                            <th class="py-3 px-6 text-center">Email</th>
                            <th class="py-3 px-6 text-center">Plan</th>
                            <th class="py-3 px-6 text-center">Agencia</th>
                            <th class="py-3 px-6 text-center">Fecha Inicio</th>
                            <th class="py-3 px-6 text-center">Fecha Vencimiento</th>
                            <th class="py-3 px-6 text-center">Fecha Pago</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Plazo</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($clients as $cliente)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-center">{{ $cliente->id }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->users ? $cliente->users->name : 'Sin community asignado' }} {{$cliente->users->last_name }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->name }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->last_name }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->phone }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->email }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->plan }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->agencia }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->start_date }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->expiration_date }}</td>
                                <td class="py-3 px-6 text-center">{{ $cliente->pay_day }}</td>
                                <td class="py-3 px-6 text-center @if(Carbon\Carbon::parse($cliente->expiration_date) <= now()) text-danger @endif">
                                    @if(Carbon\Carbon::parse($cliente->expiration_date)->isToday())
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-yellow-400 mr-2"></div> Pendiente
                                        </div>
                                    @elseif(Carbon\Carbon::parse($cliente->expiration_date) >= now())
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Activo
                                        </div>
                                    @else
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div> Vencido
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @php
                                        $diasDiferencia = Carbon\Carbon::parse($cliente->pay_day)->diffInDays(Carbon\Carbon::parse($cliente->expiration_date));
                                        $plazo = '';
                                        if ($diasDiferencia  > 365  *  3) {
                                            $plazo = 'Por Siempre';
                                        } elseif ($diasDiferencia >= 365 && $diasDiferencia  <= 365  *   3) {
                                            $plazo = 'Anual';
                                        } elseif ($diasDiferencia >= 30 && $diasDiferencia < 365) {
                                            $plazo = 'Mensual';
                                        } elseif ($diasDiferencia <= 29) {
                                            $plazo = 'No definido';
                                        }
                                    @endphp
                                    @if ($plazo === 'Mensual')
                                        <span class="text-green-500">{{ $plazo }}</span>
                                    @elseif ($plazo === 'Anual')
                                        <span class="text-blue-500">{{ $plazo }}</span>
                                    @elseif ($plazo === 'Por Siempre')
                                        <span class="text-purple-500">{{ $plazo }}</span>
                                    @elseif ($plazo === 'No definido')
                                        <span class="text-red-500">{{ $plazo }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <button onclick="window.location.href='{{ route('clients.edit', $cliente->id) }}'" class="text-gray-900 bg-gradient-to-r from-yellow-200 via-yellow-300 to-yellow-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <img src="{{ asset('img/edit.svg') }}" alt="">
                                      </button>

                                        <button data-modal-target="popup-modal-{{ $cliente->id }}" data-modal-toggle="popup-modal-{{ $cliente->id }}" type="button" class="text-white bg-gradient-to-br from-red-600 to-red-800 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            <img src="{{ asset('img/eliminar.svg') }}"  alt="">
                                        </button>

                                    </td>
                            </tr>
                            <div id="popup-modal-{{ $cliente->id }}" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal-{{ $cliente->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Seguro de eliminar este coordinador?</h3>
                                            <form action="{{ route('clients.destroy', $cliente->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button data-modal-hide="popup-modal-{{ $cliente->id }}" type="submit" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Eliminar</button>
                                            </form>
                                            <button data-modal-hide="popup-modal-{{ $cliente->id }}" type="button" class="text-white bg-gradient-to-br from-gray-700 to-gray-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Cancelar</button>
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

