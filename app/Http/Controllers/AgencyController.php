<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAgency;
use App\Models\UserCoordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class AgencyController extends Controller
{
    public function index()
    {
        $userAgencies = User::role('agency')->get();

        return view('agency.dashboard', compact('userAgencies'));
    }




    public function destroy($id)
    {
        // Iniciar la transacción
        DB::beginTransaction();

        try {
          // Obtener el usuario "coordinador" por su id
        $user = User::findOrFail($id);

        // Obtener las agencias asociadas al usuario como coordinador


        $userAgencyRows = UserAgency::where('agency_id', $id)->get();

        // Establecer coordinator_id como null para los usuarios asociados



        $userAgencyRows->each(function ($user) {
            $user->agency_id = null;
            $user->save();
        });



        // Eliminar el usuario de la tabla users
        $user->delete();

        // Confirmar la transacción
        DB::commit();

            return redirect()->route('agencys')->with('success', 'Asignación eliminada correctamente. El usuario con rol de agencia ha sido actualizado.');
        } catch (\Exception $e) {
            // En caso de error, deshacer la transacción
            DB::rollback();

            dd($e);

            return redirect()->route('agencys')->with('error', 'No se pudo eliminar la asignación. Inténtalo de nuevo más tarde.');
        }
    }

}
