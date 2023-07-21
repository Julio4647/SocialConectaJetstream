<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::all();

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

        return redirect()->route('clientes')->with('success', 'Coordinador eliminado correctamente');
    }

}
