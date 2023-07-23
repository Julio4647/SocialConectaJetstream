@include('layouts.sidenav')


<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4 dark:border-gray-700 mt-14">
                        <a href="{{ route('communitys') }}"
                            class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Regresar</a>
                        <h2 style="margin-top: 15px">Agregar Cliente</h2>
                        <form method="POST" action="{{ route('community.register') }}">
                            @csrf

                            <!-- Agregar campo para seleccionar el "coordinador" al que se quiere asignar -->
                            <div class="form-group row">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Assign to community') }}</label>

                                <div class="col-md-6">
                                    <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id" required>
                                        <option value="">Select Coordinator</option>
                                        @foreach ($communitys as $community)
                                            <option value="{{ $community->id }}">{{ $community->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('coordinador_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="coordinador_id" class="col-md-4 col-form-label text-md-right">{{ __('Assign to Coordinator') }}</label>

                                <div class="col-md-6">
                                    <select id="coordinador_id" class="form-control @error('coordinador_id') is-invalid @enderror" name="coordinador_id" required>
                                        <option value="">Select Coordinator</option>
                                        @foreach ($coordinators as $coordinator)
                                            <option value="{{ $coordinator->id }}">{{ $coordinator->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('coordinador_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>


