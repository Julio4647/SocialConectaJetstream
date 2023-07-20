<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar contraseña</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="h-screen fixed top-0">
        <div class="w-full mx-auto h-full">
            <div class="flex flex-row h-full">
                <div class="hidden sm:block sm:w-1/2">
                    <div class="relative h-full">
                        <img src="https://lirp.cdn-website.com/bae3e0e8/dms3rep/multi/opt/ShtLas8RKGMj17JHxvDg_Oficina+-+69952.v2.0000000-1920w.jpg"
                            alt="Imagen de fondo" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-purple-800 opacity-70 flex items-center justify-center">
                            <img src="{{ asset('img/Recurso 1@2x.png') }}" alt="Imagen overlay" class="w-1/2 h-auto">
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 bg-white">
                    <div class="flex items-center justify-center h-full px-5 sm:px-0">



                        <form method="POST" action="{{ route('password.email') }}">
                            <div class="flex justify-start items-center">
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"><img
                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAYUlEQVR4nO3UMQqAMBBE0X+JBL3/SdRCFG20yHEUJYKVVRgF50GKrT6EZcHMrLAIzECjjq7ABgyqaACWHE1A5WhpU/5exeveCrdPS1UjFH4bj7cDMirDV/xYuP6czMy+ZAcJB1CbbvpUogAAAABJRU5ErkJggg=="></a>
                            </div>
                            <div class="flex justify-start items-center mt-4">
                                <h1 style="font-size: 1.5rem"><b>Recuperar mi Contraseña</b></h1>
                            </div>
                            <div class="flex justify-start items-center ">
                                <h1>Ingresa tu correo electronico</h1>
                            </div>
                            <div class="flex justify-center items-center mt-12">
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <x-validation-errors class="mb-4" />
                            </div>
                            @csrf

                            <div class="block">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                            <div class="flex justify-center items-center mt-4">
                                <x-button
                                    class="w-full text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center justify-center">
                                    {{ __('Enviar') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
