@include('layouts.sidenav')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4 dark:border-gray-700 mt-14">
                        <a href="{{ route('clientes') }}"
                            class="text-white bg-gradient-to-br from-green-400 to-green-700 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Regresar</a>
                        <h2 style="margin-top: 15px">Agregar Cliente</h2>
                        <form action="{{ route('clients.store') }}" method="POST">
                            @csrf
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" required>
                            <br>

                            <label for="last_name">Apellido:</label>
                            <input type="text" name="last_name" required>
                            <br>

                            <label for="phone">Teléfono:</label>
                            <input type="text" name="phone" required>
                            <br>

                            <label for="email">Email:</label>
                            <input type="email" name="email" required>
                            <br>

                            <label for="start_date">Fecha de inicio:</label>
                            <input type="date" name="start_date" required>
                            <br>

                            <label for="expiration_date">Fecha de expiración:</label>
                            <input type="date" name="expiration_date" required>
                            <br>

                            <label for="pay_day">Día de pago:</label>
                            <input type="date" name="pay_day" required>
                            <br>

                            <label for="communitys_id">ID de comunidad:</label>
                            <select name="communitys_id" required>
                                <option value="">Seleccionar comunidad</option>
                                @foreach ($communities as $community)
                                    <option value="{{ $community->id }}">{{ $community->name }}</option>
                                @endforeach
                            </select>
                            <br>

                            <button type="submit">Registrar</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>

<div class="modal fade" id="limitModal" tabindex="-1" role="dialog" aria-labelledby="limitModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="limitModalLabel">Límite de clientes alcanzado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                El usuario con el rol "community" ya ha alcanzado el límite máximo de 17 clientes. No es posible
                registrar más clientes en este momento.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Agrega este script al final del body o en un archivo JavaScript -->
<script>
    @if (session('limit_exceeded'))
        // Mostrar el modal cuando se detecte que se ha alcanzado el límite de clientes
        $(document).ready(function() {
            $('#limitModal').modal('show');
        });
    @endif
</script>


<script>

    function getNextMonthDate(dateString) {
        let currentDate = new Date(dateString);
        let nextMonthDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());


        let year = nextMonthDate.getFullYear();
        let month = (nextMonthDate.getMonth() + 1).toString().padStart(2, '0');
        let day = nextMonthDate.getDate().toString().padStart(2, '0');
        return `${year}-${month}-${day}`;
    }


    $(document).ready(function() {
        $('input[name="pay_day"]').on('change', function() {
            let selectedDate = $(this).val();
            let nextMonthDate = getNextMonthDate(selectedDate);
            $(this).val(nextMonthDate);
        });
    });
</script>
