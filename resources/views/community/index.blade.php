@include('layouts.sidenav')

<div class="p-4 sm:ml-64">
    <div class="p-4 dark:border-gray-700 mt-14">
        <div class="my-6">
            <h1 style="font-size: 1.5rem">
                <p>COMMUNITY MANAGER</p>
            </h1>
        </div>
        <a href="{{ route('community.create') }}"
                class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                Asignar Coordinador a Community
        </a>
        <div class="bg-white shadow-2xl rounded my-6">
            <div class="overflow-x-auto">
                <table class="min-w-max w-full table-auto" style="margin-top: 15px">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Nombrey</th>
                            <th class="py-3 px-6 text-left">Apellido</th>
                            <th class="py-3 px-6 text-left">Coordinador</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Role</th>
                            <th class="py-3 px-6 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">

                        @include('include.community.valCoor')

                        @include('include.community.valAdmin')

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
