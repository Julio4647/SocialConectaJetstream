@include('layouts.sidenav')

<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4  dark:border-gray-700 mt-14">
                        <a href="{{ route('cordinador') }}"
                            class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Regresar</a>
                        <h2 style="margin-top: 15px">Asignar Agency Manager a Coordinador</h2>
                        <form action="{{ route('coordinador.register') }}" method="POST" >
                            @csrf
                            <div class="grid grid-cols-4 gap-5 py-8">
                                <div class="form-group">
                                    <label for="coordinator_id" class="" style="text-align: center ">{{ __('Asignar Coordinador') }}</label>
                                    <select id="coordinator_id" class="form-control @error('coordinator_id') is-invalid @enderror" style="margin-top: 20px"
                                        name="coordinator_id" required>
                                        <option value="">Coordinador</option>
                                        @foreach ($coordinators as $coordinator)
                                            <option value="{{ $coordinator->id }}">{{ $coordinator->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('coordinator_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agency_id" class="">{{ __('Asignar Agency Manager') }}</label>
                                    <select id="agency_id" class="form-control @error('agency_id') is-invalid @enderror" name="agency_id" required style="margin-top: 20px">
                                        <option value="">Agency Manager</option>
                                        @foreach ($agencies as $agency)
                                            <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('agency_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mt-4 ">
                                <button type="submit" class="w-60 text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
</x-app-layout>
