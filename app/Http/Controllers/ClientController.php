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
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener los roles del usuario usando la relación "roles"
        $roles = $user->roles->pluck('name');


        if ($roles->contains('admin')) {
            // Si el usuario tiene el rol "admin", mostrar todos los clientes
            $clients = Client::all();

        } elseif ($roles->contains('agency')) {
                // Si el usuario tiene el rol "admin", mostrar todos los clientes
                $clients = Client::all();
         } elseif ($roles->contains('coordinador')) {
                // Si el usuario tiene el rol "admin", mostrar todos los clientes
                $clients = Client::all();
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
