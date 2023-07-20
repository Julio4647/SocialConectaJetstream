<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="h-screen fixed top-0">
        <div class="w-full mx-auto h-full">
          <div class="flex flex-row h-full">
            <div class="hidden sm:block sm:w-1/2">
              <div class="relative h-full">
                <img src="https://lirp.cdn-website.com/bae3e0e8/dms3rep/multi/opt/ShtLas8RKGMj17JHxvDg_Oficina+-+69952.v2.0000000-1920w.jpg" alt="Imagen de fondo" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-purple-800 opacity-70 flex items-center justify-center">
                  <img src="{{asset('img/Recurso 1@2x.png')}}" alt="Imagen overlay" class="w-1/2 h-auto">
                </div>
              </div>
            </div>
            <div class="w-full sm:w-1/2 bg-white">
              <div class="flex items-center justify-center h-full px-5 sm:px-0">
                <form class="w-80" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="flex justify-center items-center mt-4">
                        <x-button class="w-full text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center justify-center">
                            {{ __('Iniciar Seción') }}
                        </x-button>
                    </div>




                    <div class="flex justify-start items-center mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-purple-900 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste la Contraseña?') }}
                            </a>
                        @endif
                    </div>
                    <div class="flex justify-start items-center mt-4">
                        @if (Route::has('register'))
                            <a class="underline text-sm text-purple-900 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center" href="{{ route('register') }}">
                                Registrar
                            </a>
                        @endif
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
