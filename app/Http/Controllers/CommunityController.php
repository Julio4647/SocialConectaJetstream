<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\UserCoordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    public function index()
    {
        // Obtiene todos los usuarios con rol "community"
        $communityUsers = User::role('community')->get();

        // Retorna la vista con la lista de usuarios "communitys"
        return view('community.dashboard', compact('communityUsers'));
    }


    public function showRegistrationForm()
    {
        // Obtener la lista de coordinadores disponibles para mostrar en el formulario
        $coordinators = User::role('coordinador')->get();
        $communitys = User::role('community')->get();
        return view('community.create', compact('coordinators', 'communitys'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'coordinador_id' => 'required|exists:users,id',
        ]);

        // Obtener el ID del coordinador seleccionado
        $communitysId = $request->input(('user_id'));
        $coordinatorId = $request->input('coordinador_id');

        // Crear un nuevo registro en la tabla user_coordinator
        UserCoordinator::create([
            'user_id' => $communitysId,
            'coordinator_id' => $coordinatorId,
        ]);

        return redirect()->route('communitys')->with('success', 'Usuario "community" registrado correctamente.');
    }


    public function destroy($id)
    {
// Iniciar la transacción
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            // Obtener los clientes asociados al usuario "community"
            $clients = $user->client;

            // Establecer communitys_id como el valor por defecto (por ejemplo, -1) para los clientes asociados
            if ($clients) {
                $clients->each(function ($client) {
                    $client->communitys_id = null; // O el valor por defecto que hayas definido
                    $client->save();
                });
            }


            // Eliminar todas las relaciones con coordinadores en la tabla user_coordinator
            $user->coordinators()->detach();

            // Eliminar al usuario "community" de la tabla users
            $user->delete();

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('communitys')->with('success', 'Usuario "community" eliminado correctamente.');
        } catch (\Exception $e) {
            // En caso de error, deshacer la transacción
            DB::rollback();

            return redirect()->route('communitys')->with('error', 'No se pudo eliminar el usuario "community". Inténtalo de nuevo más tarde.');
        }
    }

}
