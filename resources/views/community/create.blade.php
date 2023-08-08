@include('layouts.sidenav')


<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4 dark:border-gray-700 mt-14">
                       <button onclick="window.location='{{ route('communitys') }}'"
                                    class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <img src="{{ asset('img/regreso.svg') }}" alt="" class="w-4 h-4 mr-2 inline-block"></button>

                            <div class="flex justify-center py-4">
                                <h2 class="text-xl md:text-2xl lg:text-3xl xl:text-4xl mt-4 md:mt-6 lg:mt-8 xl:mt-10">Asignar Coordinador a Community Manager</h2>
                            </div>
                            <form method="POST" action="{{ route('community.register') }}">
                            @csrf

                            <!-- Agregar campo para seleccionar el "coordinador" al que se quiere asignar -->


                            <div class="w-full p-1">
                                <label for="coordinador_id" class="col-md-4 col-form-label text-md-right">{{ __('Coordinador') }}</label>

                                <div class="col-md-6">
                                    <select id="coordinador_id" class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('coordinador_id') is-invalid @enderror" name="coordinador_id" required>
                                        <option value="">Selecciona Coordinator</option>
                                        @foreach ($coordinators as $coordinator)
                                            <option value="{{ $coordinator->id }}">{{ $coordinator->name }} {{ $coordinator->last_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('coordinador_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-full p-1">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Community Manager') }}</label>

                                <div class="col-md-6">
                                    <select id="user_id" class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('user_id') is-invalid @enderror" name="user_id" required>
                                        <option value="">Selecciona Community Manager</option>
                                        @foreach ($communitys as $community)
                                            <option value="{{ $community->id }}">{{ $community->name }} {{ $community->last_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('coordinador_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="w-full p-2 py-5">
                                <button type="submit" class="w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded">
                                    {{ __('Asignar') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>


