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

        $totalClientes = null; // Inicializamos la variable totalClientes en 0
        $clientesActivos = null; // O puedes asignar otro valor predeterminado
        $clientesPendientes = null; // O puedes asignar otro valor predeterminado
        $clientesVencidos = null; // O puedes asignar otro valor predeterminado


        if ($roles->contains('admin')) {
            // Código para mostrar información específica para el rol "admin"

            //Administrador

            $clients = Client::all();



            $totalClientes = $clients->count();

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
        } elseif ($roles->contains('agency')) {


            //Agency

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

            $totalClientes = $clients->count();

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

            $totalClientes = $clients->count();

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
        } elseif ($roles->contains('community')) {
            //Communitys


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
        } else {
            // Código para mostrar información específica para otros roles, si es necesario
        }

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

        // Redirigir según el rol asignado
        if ($request->role === 'admin') {
            return redirect()->route('administradores'); // Cambia 'vista1' por el nombre de tu ruta
        } elseif ($request->role === 'agency') {
            return redirect()->route('agencys'); // Cambia 'vista2' por el nombre de otra ruta
        } elseif ($request->role === 'coordinador') {
            return redirect()->route('cordinador'); // Cambia 'vista2' por el nombre de otra ruta
        } else {
            return redirect()->route('communitys'); // Redirigir a una vista por defecto o manejar otros casos
        }
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
