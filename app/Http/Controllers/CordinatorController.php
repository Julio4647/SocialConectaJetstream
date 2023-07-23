<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserCoordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CordinatorController extends Controller
{


    public function index()
    {


            $coordinadors = User::role('coordinador')->get();

            return view('coordinadores.dashboard', compact('coordinadors'));
    }

    public function destroy($id)
    {
        // Iniciar la transacción
        DB::beginTransaction();

        try {
            $coordinador = User::findOrFail($id);

        // Obtener los usuarios asociados que tienen este coordinador asignado
        $associatedUsers = UserCoordinator::where('coordinator_id', $id)->get();

        // Establecer coordinator_id como null para los usuarios asociados
        $associatedUsers->each(function ($user) {
            $user->coordinator_id = null;
            $user->save();
        });

        // Eliminar al coordinador de la tabla users
        $coordinador->delete();

        // Confirmar la transacción
        DB::commit();


            return redirect()->route('cordinador')->with('success', 'Coordinador eliminado correctamente. Los communitys asociados se han actualizado.');
        } catch (\Exception $e) {
            // En caso de error, deshacer la transacción
            DB::rollback();
            dd($e);

            return redirect()->route('cordinador')->with('error', 'No se pudo eliminar el coordinador. Inténtalo de nuevo más tarde.');
        }
    }
}
