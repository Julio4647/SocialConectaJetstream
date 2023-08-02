<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class GrlController extends Controller
{
    public function index()
    {
        $datos = Note::all(); // Suponiendo que tienes un modelo 'Nota' para las notas



        $user = Auth::user();

        // Obtener los roles del usuario usando la relación "roles"
        $roles = $user->roles->pluck('name');

        $totalClientes = 0; // Inicializamos la variable totalClientes en 0

        // Si el usuario tiene el rol "community", mostrar solo los clientes asignados a su ID
        $clients = Client::where('communitys_id', $user->id)->get();
        $totalClientes = $clients->count(); // Obtenemos el total de clientes para el rol "community"

        $clientesActivos = $clients->filter(function ($cliente) {
            return Carbon::parse($cliente->expiration_date) >= now();
        })->count();

        // Calcular el número de clientes cancelados o vencidos
        $clientesVencidos = $clients->filter(function ($cliente) {
            return Carbon::parse($cliente->expiration_date) <= now();
        })->count();

        // Calcular el número de clientes pendientes
        $clientesPendientes = $clients->filter(function ($cliente) {
            return Carbon::parse($cliente->expiration_date)->isToday();
        })->count();

        return view('dashboard', compact('datos', 'clientesActivos', 'clientesPendientes', 'clientesVencidos', 'totalClientes', 'clients', 'roles'));
    }


    public function register()
    {

        return view('register.dashboard');
    }

    public function crearusuarios(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $administradores = new User;
        $administradores->name = $request->name;
        $administradores->last_name = $request->last_name;
        $administradores->email = $request->email;
        $administradores->password = Hash::make($request->password);
        $administradores->save();

        $administradores->assignRole($request['role']);

        return redirect()->route('register');
    }

    public function guardarNota(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ])->validate();

        Note::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('dashboard');
    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $datos = Note::where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->get();

        return view('dashboard', ['datos' => $datos]);
    }

    //Administradores


    public function administradores()
    {
        $administradores = User::role('admin')->get();

        return view('administradores.dashboard', compact('administradores'));
    }



    public function crearadministradores()
    {
        return view('administradores.create');
    }

    public function guardaradministradores(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $administradores = new Admin;
        $administradores->name = $request->name;
        $administradores->last_name = $request->last_name;
        $administradores->email = $request->email;
        $administradores->password = Hash::make($request->password);
        $administradores->save();

        $administradores->assignRole('admin');

        return redirect()->route('administradores');
    }



    public function actualizaradministradores($id)
    {

        $administradores = User::findOrFail($id);

        return view('administradores.update', compact('administradores'));
    }


    public function updateadministradores(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscar el coordinador por su ID
        $administradores = User::findOrFail($id);

        // Actualizar los datos del coordinador
        $administradores->name = $request->name;
        $administradores->last_name = $request->last_name;
        $administradores->email = $request->email;
        $administradores->password = Hash::make($request->password);

        // Guardar los cambios en la base de datos
        $administradores->save();

        // Redireccionar a la página de visualización del coordinador actualizado
        return redirect()->action([GrlController::class, 'administradores'])->with('success', 'Coordinador actualizado exitosamente');
    }




    public function eliminaradministradores($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->action([GrlController::class, 'administradores'])->with('success', 'Coordinador eliminado correctamente');
    }
}
