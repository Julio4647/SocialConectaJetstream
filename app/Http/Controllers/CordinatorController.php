<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAgency;
use App\Models\UserCoordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CordinatorController extends Controller
{


    public function index()
    {
        $userAgencies = User::role('coordinador')->get();
        $agencies = User::role('agency')->get();
        $communityUsers = User::role('community')->get();


        $coordinatorId = Auth::id();
        $user = Auth::user();
        $roles = $user->roles->pluck('name');


        $userIds = [];
        $userCom = [];

        foreach ($userAgencies as $users) {
            // Comprueba si $users->agency->first() no es nulo antes de acceder a la propiedad 'id'
            if ($users->agency->first()?->id === $coordinatorId) {
                // Si la condición se cumple, agrega el ID del usuario actual al array $userIds
                $userIds[] = $users->id;
            } else {
                // Puedes agregar un bloque de código aquí para manejar el caso en que la condición no se cumpla, si es necesario.
            }
        }


        foreach ($communityUsers as $userss) {
            // Verifica si el ID del coordinador está en el array $userIds
            if (in_array($userss->coordinators->first()?->id, $userIds)) {
                // Si el ID del coordinador está en el array $userIds, agrega el ID del usuario actual al array $userCom
                $userCom[] = $userss;
            }
        }




        $coordinatorAgency = $user->agency;



        return view('coordinadores.dashboard', compact('userAgencies', 'agencies', 'coordinatorId', 'roles', 'coordinatorAgency', 'userIds', 'userCom'));
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
