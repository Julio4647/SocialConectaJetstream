<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class GrlController extends Controller
{
    public function index(){
        $datos = Note::all(); // Suponiendo que tienes un modelo 'Nota' para las notas
        //return $datos;
        return view('dashboard',compact('datos'));
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

        return view('layouts.dashboard', ['datos' => $datos]);
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

        $administradores = Admin::findOrFail($id);

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
        $administradores = Admin::findOrFail($id);

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
        $administrador = Admin::findOrFail($id);
        $administrador->delete();

        return redirect()->action([GrlController::class, 'administradores'])->with('success', 'Coordinador eliminado correctamente');
    }

    //coordinadores

    public function cordinators()
    {


            $coordinadors = User::role('coordinador')->get();

            return view('coordinadores.dashboard', compact('coordinadors'));
    }



    ///Communitys
    public function communitys()
    {

        $communitys = User::role('community')->get();

        return view('community.dashboard', compact('communitys'));
    }

}
