<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function index()
    {

        $communityUsers = User::role('community')->get();
        $coordinators = User::role('coordinador')->get();
        $coordinatorId = Auth::id();
        // Obtener el usuario autenticado
        $user = Auth::user();
        // Obtener los roles del usuario usando la relación "roles"
        $roles = $user->roles->pluck('name');

        $userIds = [];
        $userCom = [];
        $clients = [];


        if ($roles->contains('admin')) {
            // Si el usuario tiene el rol "admin", mostrar todos los clientes
            $clients = Client::all();
        } elseif ($roles->contains('agency')) {

            // Si el usuario tiene el rol "admin", mostrar todos los clientes
            foreach ($coordinators as $coordinator) {
                // Comprueba si $coordinator->agency->first() no es nulo antes de acceder a la propiedad 'id'
                if ($coordinator->agency->first() && $coordinator->agency->first()->id === $coordinatorId) {
                    // Si la condición se cumple, agrega el ID del coordinador actual al array $userIds
                    $userIds[] = $coordinator->id;
                }
            }

            foreach ($communityUsers as $user) {
                // Verifica si el ID del coordinador está en el array $userIds
                if (in_array($user->coordinators->first()?->id, $userIds)) {
                    // Si el ID del coordinador está en el array $userIds, agrega el modelo actual al array $userCom
                    $userCom[] = $user;
                }
            }

            // Obtener los IDs de los usuarios community en el array $userCom
            $userIds = array_map(function ($user) {
                return $user->id;
            }, $userCom);

            // Obtener todos los clientes cuyo campo 'communitys_id' coincida con alguno de los IDs en $userIds
            $clients = Client::whereIn('communitys_id', $userIds)->get();


        } elseif ($roles->contains('coordinador')) {


            foreach ($communityUsers as $user) {
                // Verifica si el ID del coordinador está en el array $userIds
                if (($user->coordinators->first()?->id === $coordinatorId)) {
                    // Si el ID del coordinador está en el array $userIds, agrega el modelo actual al array $userCom
                    $userCom[] = $user;
                }
            }

            // Obtener los IDs de los usuarios community en el array $userCom
            $userIds = array_map(function ($user) {
                return $user->id;
            }, $userCom);

            // Obtener todos los clientes cuyo campo 'communitys_id' coincida con alguno de los IDs en $userIds
            $clients = Client::whereIn('communitys_id', $userIds)->get();

        } elseif ($roles->contains('community')) {
            // Si el usuario tiene el rol "community", mostrar solo los clientes asignados a su ID
            $clients = Client::where('communitys_id', $user->id)->get();
            $totalClients = $clients->count();
        } else {
            // En caso de que el usuario tenga otro rol, muestra un mensaje de error o haz lo que sea apropiado para tu caso
            abort(403, 'Acceso denegado');
        }



        return view('clientes.dashboard', compact('clients'));
    }


    public function create()
    {
        $communities = User::role('community')->get();

        return view('clientes.create', compact('communities'));
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:clients',
            'plan' => 'required|string',
            'agencia' => 'required|string',
            'start_date' => 'required|date',
            'expiration_date' => 'required|date',
            'pay_day' => 'required|date',
            'communitys_id' => 'required|exists:users,id',
        ]);

        // Verificar si el usuario ya tiene 17 clientes asignados
        $communityId = $validatedData['communitys_id'];
        $assignedClientsCount = Client::where('communitys_id', $communityId)->count();

        if ($assignedClientsCount >= 17) {
            // Si el usuario ya tiene 17 clientes asignados, mostrar un mensaje de error
            return redirect()->back()->with('limit_exceeded', true);
        }

        // Crear el nuevo cliente si el límite no se ha alcanzado
        $client = Client::create($validatedData);

        // Puedes agregar aquí cualquier lógica adicional, como redireccionar a otra página o mostrar un mensaje de éxito.

        return redirect()->route('clientes')->with('success', 'Cliente registrado exitosamente.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $communities = User::role('community')->get();

        return view('clientes.update', compact('client', 'communities'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email,' . $id,
            'plan' => 'required|string',
            'agencia' => 'required|string',
            'start_date' => 'required|date',
            'expiration_date' => 'required|date',
            'pay_day' => 'required|date',
            'communitys_id' => 'required|exists:users,id',
        ]);

        $client = Client::findOrFail($id);
        $client->update($validatedData);

        return redirect()->route('clientes')->with('success', 'Cliente actualizado exitosamente.');
    }



    public function destroy($id)
    {
        $cliente = Client::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes')->with('success', 'cliente eliminado correctamente');
    }
}
