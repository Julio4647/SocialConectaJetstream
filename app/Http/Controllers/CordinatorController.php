<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAgency;
use App\Models\UserCoordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CordinatorController extends Controller
{


    public function index()
    {
        $userAgencies = User::role('coordinador')->get();
        $agencies = User::role('agency')->get();

        return view('coordinadores.dashboard', compact('userAgencies', 'agencies'));
    }

    public function create()
    {
        $coordinators = User::role('coordinador')->get();
        $agencies = User::role('agency')->get();
        return view('coordinadores.create', compact('agencies', 'coordinators'));
    }


    public function store(Request $request)
    {

        Try{
            // Valida los datos del formulario
        $validatedData = $request->validate([
            'agency_id' => 'nullable|exists:users,id',
            'coordinator_id' => 'required|exists:users,id',
        ]);

        // Crea un nuevo modelo UserAgency con los datos validados
        $userAgency = new UserAgency();
        $userAgency->agency_id = $request->input('agency_id');
        $userAgency->coordinator_id = $request->input('coordinator_id');

        // Guarda el nuevo registro en la base de datos
        $userAgency->save();

        } catch(\Exception $e) {
            dd($e);
        }

        return redirect()->route('cordinador')->with('success', 'Asignación creada correctamente.');
    }

    public function updateAgencyId(Request $request, $coordinatorId)
    {
        // Valida el nuevo agency_id del formulario
        $validatedData = $request->validate([
            'agency_id' => 'nullable|exists:users,id',
        ]);

        // Encuentra el registro existente con el coordinator_id proporcionado
        $userAgency = UserAgency::where('coordinator_id', $coordinatorId)->first();

        // Si no se encuentra el registro, puedes mostrar un mensaje de error o redireccionar a alguna otra parte de la aplicación
        if (!$userAgency) {
            return redirect()->back()->with('error', 'Registro no encontrado');
        }

        // Actualiza el agency_id con el valor proporcionado
        $userAgency->agency_id = $request->input('agency_id');

        // Guarda los cambios en la base de datos
        $userAgency->save();

        // Redirecciona a donde desees después de actualizar el registro
        return redirect()->route('cordinador')->with('success', 'Registro actualizado exitosamente');
    }


    public function destroy($id)
    {
        // Iniciar la transacción
        DB::beginTransaction();

        try {
          // Obtener el usuario "coordinador" por su id
        $user = User::findOrFail($id);

        // Obtener las agencias asociadas al usuario como coordinador

        $associatedUsers = UserCoordinator::where('coordinator_id', $id)->get();

        $userAgencyRows = UserAgency::where('coordinator_id', $id)->get();

        // Establecer coordinator_id como null para los usuarios asociados

        $associatedUsers->each(function ($user) {
            $user->coordinator_id = null;
            $user->save();
        });

        $userAgencyRows->each(function ($user) {
            $user->coordinator_id = null;
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
