@include('layouts.sidenav')



<div class="p-4 sm:ml-64">
    <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <form method="POST" >
            @csrf

            <select name="role" id="role" required>
              <option value="">Selecciona un rol</option>
              <option value="admin">Admin</option>
              <option value="coordinador">Coordinador</option>
              <option value="community">Community</option>
              <option value="agency">Agency</option>
            </select>

            <div class="text-left">
              <div class="py-8"></div>
              <div class="mb-4">
                <input name="name" type="text" id="inputName" class="form-input w-full px-4 py-3 rounded-lg" placeholder="Nombre" required>
                <div class="error-message" id="nameError"></div>
              </div>
              <div class="mb-4">
                <input name="last_name" type="text" id="inputLast_name" class="form-input w-full px-4 py-3 rounded-lg" placeholder="Apellidos" required>
                <div class="error-message" id="lastNameError"></div>
              </div>
              <div class="mb-4">
                <input name="email" type="email" id="inputEmail" class="form-input w-full px-4 py-3 rounded-lg" placeholder="Email" required>
                <div class="error-message" id="emailError"></div>
              </div>
              <div class="mb-4">
                <input name="password" type="password" id="inputPassword" class="form-input w-full px-4 py-3 rounded-lg" placeholder="Contraseña" required>
                <div class="error-message" id="passwordError"></div>
              </div>
              <div class="mb-4">
                <input name="password_confirmation" type="password" id="inputRepeatPassword" class="form-input w-full px-4 py-3 rounded-lg" placeholder="Repite Contraseña" required>
                <div class="error-message" id="passwordConfirmationError"></div>
              </div>
              <div class="mt-6 mb-4">
                <button type="submit" class="w-full text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Registrar</button>
              </div>
            </div>
          </form>

    </div>
</div>

