@include('layouts.sidenav')


<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4 dark:border-gray-700 mt-14">
                        <a href="{{ route('clientes') }}"
                            class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Regresar</a>
                        <h2 style="margin-top: 15px">Agregar Cliente</h2>
                        <form action="{{ route('clients.update', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" value="{{ $client->name }}" required>
                            <br>

                            <label for="last_name">Apellido:</label>
                            <input type="text" name="last_name" value="{{ $client->last_name }}" required>
                            <br>

                            <label for="phone">Teléfono:</label>
                            <input type="text" name="phone" value="{{ $client->phone }}" required>
                            <br>

                            <label for="email">Email:</label>
                            <input type="email" name="email" value="{{ $client->email }}" required>
                            <br>

                            <label for="start_date">Fecha de inicio:</label>
                            <input type="date" name="start_date" value="{{ $client->start_date }}" required>
                            <br>

                            <label for="expiration_date">Fecha de expiración:</label>
                            <input type="date" name="expiration_date" value="{{ $client->expiration_date }}" required>
                            <br>

                            <label for="pay_day">Día de pago:</label>
                            <input type="date" name="pay_day" value="{{ $client->pay_day }}" required>
                            <br>

                            <!-- Resto de los campos del formulario (phone, email, start_date, expiration_date, pay_day) -->

                            <label for="communitys_id">Comunidad:</label>
                            <select name="communitys_id" required>
                                <option value="">Seleccionar comunidad</option>
                                @foreach ($communities as $community)
                                    <option value="{{ $community->id }}" @if ($community->id === $client->communitys_id) selected @endif>
                                        {{ $community->name }}
                                    </option>
                                @endforeach
                            </select>
                            <br>

                            <button type="submit">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
