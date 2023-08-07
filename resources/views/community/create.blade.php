@include('layouts.sidenav')


<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4 dark:border-gray-700 mt-14">
                        <a href="{{ route('communitys') }}"
                            class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Regresar</a>
                            <div class="flex justify-center py-4">
                                <h2 class="text-xl md:text-2xl lg:text-3xl xl:text-4xl mt-4 md:mt-6 lg:mt-8 xl:mt-10">Asignar Coordinador a Community Manager</h2>
                            </div>
                            <form method="POST" action="{{ route('community.register') }}">
                            @csrf

                            <!-- Agregar campo para seleccionar el "coordinador" al que se quiere asignar -->
                            <div class="w-full p-1">
                                <label for="user_id">Agency Manager:</label>
                                <select name="user_id" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Selecciona Agency Manager</option>
                                    @foreach ($communitys as $community)
                                        <option value="{{ $community->id }}">{{ $community->name }} {{ $community->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full p-1">
                                <label for="coordinator_id">Coordinador:</label>
                                <select name="coordinator_id" required class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Selecciona Coordinador</option>
                                    @foreach ($coordinators as $coordinator)
                                        <option value="{{ $coordinator->id }}">{{ $coordinator->name }} {{ $coordinator->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="w-full p-2 py-5">
                                <button type="submit" class="w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>


