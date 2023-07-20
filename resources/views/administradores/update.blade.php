@include('layouts.sidenav')
<x-app-layout>
    <div class="">
        <div class=" ">
            <div class="bg-white ">
                <div class="p-4 sm:ml-64">
                    <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
                        <form action="{{ route('administradores.update', $administradores->id) }}" method="POST" class="p-4 md:w-1/2 lg:w-1/3 xl:w-1/4 mx-auto">
                            @csrf
                            {{method_field('PUT')}}

                            <div class="mb-4">
                                <label for="name" class="block mb-2">Nombre:</label>
                                <input type="text" id="name" name="name" value="{{ $administradores->name }}" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div class="mb-4">
                                <label for="last_name" class="block mb-2">Apellidos:</label>
                                <input type="text" id="last_name" name="last_name" value="{{ $administradores->last_name }}" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block mb-2">Email:</label>
                                <input type="email" id="email" name="email" value="{{ $administradores->email }}" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block mb-2">Password:</label>
                                <input type="password" id="password" name="password" value="{{ $administradores->password }}" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>



                            <div class="text-center">
                                <button type="submit" value="Guardar"
                                    class="bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 text-white font-medium rounded-lg text-sm px-5 py-2.5">
                                    Guardar cambios
                                </button>
                            </div>
                        </form>

                       <div class="grid grid-cols-3 gap-4 mb-4">
                          <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                          <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                          <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                       </div>
                       <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
                          <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                       </div>
                       <div class="grid grid-cols-2 gap-4 mb-4">
                          <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                          <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                          <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                          <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                       </div>
                       <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
                          <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                       </div>
                       <div class="grid grid-cols-2 gap-4">
                          <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                          <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                          <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                          <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
                          </div>
                       </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</x-app-layout>


