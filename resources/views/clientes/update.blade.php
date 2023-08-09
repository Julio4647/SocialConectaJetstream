@include('layouts.sidenav')


<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4 dark:border-gray-700 mt-14">
                        <button onclick="window.location='{{ route('clientes') }}'"
                                    class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <img src="{{ asset('img/regreso.svg') }}" alt="" class="w-4 h-4 mr-2 inline-block"></button>
                        <h2 style="margin-top: 15px; font-size: 25px " class="w-full md:w-1/3 p-2"><P>ACTUALIZAR CLIENTE</P></h2>
                        <form action="{{ route('clients.update', $client->id) }}" method="POST" class="flex flex-wrap justify-center">
                            @csrf
                            @method('PUT')

                            <div class="w-full md:w-1/3 p-2">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" value="{{ $client->name }}" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full md:w-1/3 p-2">
                                <label for="last_name">Apellido:</label>
                                <input type="text" name="last_name" value="{{ $client->last_name }}"  required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full md:w-1/3 p-2">
                                <label for="phone">Teléfono:</label>
                                <input type="text" name="phone" value="{{ $client->phone }}" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full md:w-1/3 p-2">
                                <label for="email">Email:</label>
                                <input type="email" name="email" value="{{ $client->email }}" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full md:w-1/3 p-2">
                                <label for="text">Plan:</label>
                                <select  name="plan" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="{{ $client->plan}}">{{ $client->plan}}</option>
                                    <option value="esencial">esencial</option>
                                    <option value="indispensable">indispensable</option>
                                    <option value="todo_en_uno">todo en Uno</option>
                                    <option value="profesional">profesional</option>
                                    <option value="omnipresente">omnipresente</option>

                                </select>
                            </div>

                            <div class="w-full md:w-1/3 p-2">
                                <label for="text">Agencia:</label>
                                <input type="text" name="agencia" value="{{ $client->agencia}}" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full md:w-1/3 p-2">
                                <label for="start_date">Fecha de inicio:</label>
                                <input type="date" name="start_date" value="{{ $client->start_date }}" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full md:w-1/3 p-2">
                                <label for="expiration_date">Fecha de expiración:</label>
                                <input type="date" name="expiration_date" value="{{ $client->expiration_date }}" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full md:w-1/3 p-2">
                                <label for="pay_day">Día de pago:</label>
                                <input type="date" name="pay_day" value="{{ $client->pay_day }}" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full p-2">

                                <label for="communitys_id">ID de comunidad:</label>
                                <select name="communitys_id" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Selecciona un Community Manager</option>
                                    @foreach ($communities as $community)
                                    <option value="{{ $community->id }}" @if ($community->id === $client->communitys_id) selected @endif>
                                        {{ $community->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full p-2 py-5">
                                <button type="submit" class="w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
