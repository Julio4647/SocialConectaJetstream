@extends('layouts.sidenav')


<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
                        <a href="{{ route('cordinador') }}" class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Regresar</a>
                        <form action="{{ route('coordinador.update.agency', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="p-4">
                                <div class="mb-4">
                                    <label for="agency_id" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Agencia:</label>
                                    <select name="agency_id" id="agency_id" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Sin asignar</option>
                                        @foreach ($agencias as $agencia)
                                            <option value="{{ $agencia->id }}" @if($user->agency->count() > 0 && $user->agency->first()->id === $agencia->id) selected @endif>{{ $agencia->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="text-white bg-gradient-to-br from-yellow-500 to-yellow-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-yellow-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>

