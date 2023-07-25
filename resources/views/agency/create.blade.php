@include('layouts.sidenav')

<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4  dark:border-gray-700 mt-14">
                        <a href="{{ route('agencys') }}" class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Regresar</a>
                        <h2 style="margin-top: 15px">Agregar Administrador</h2>
                        <form action="{{ route('agencies.register') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="agency_id" class="col-md-4 col-form-label text-md-right">{{ __('Assign to Agency Manager') }}</label>

                                <div class="col-md-6">
                                    <select id="agency_id" class="form-control @error('agency_id') is-invalid @enderror" name="agency_id" required>
                                        <option value="">Select Agency Manager</option>
                                        @foreach ($agencies as $agency)
                                            <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('coordinator_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="coordinator_id" class="col-md-4 col-form-label text-md-right">{{ __('Assign to Coordinator') }}</label>

                                <div class="col-md-6">
                                    <select id="coordinator_id" class="form-control @error('coordinator_id') is-invalid @enderror" name="coordinator_id" required>
                                        <option value="">Select Coordinator</option>
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
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>                        </form>

            </div>
        </div>
    </div>
</x-app-layout>

