<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CordinatorController;
use App\Http\Controllers\GrlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard',[GrlController::class,'index'
    ])->name('dashboard');

    Route::get('/resgistro_usuarios', [GrlController::class,'register'])->name('register');

    Route::post('/resgistro_usuarios', [GrlController::class,'crearusuarios'])->name('registro.save');

    Route::post('nota/save', [GrlController::class, 'guardarNota'])->name('notaSave');
    Route::post('/search', [GrlController::class, 'search'])->name('notes.search');

    //Administardores

    Route::get('administradores', [GrlController::class, 'administradores'
    ])->name('administradores');

    Route::get('/crear-administradores', [GrlController::class, 'crearadministradores'
    ])->name('administradores.crear');

    Route::post('/administradores', [GrlController::class, 'guardaradministradores'])->name('administradores.guardar');

    Route::delete('/administradores/{id}', [GrlController::class, 'eliminaradministradores'])->name('administradores.eliminar');
    //Actualizar

    Route::put('/administradores/{id}',  [GrlController::class, 'updateadministradores'])->name('administradores.actualizar');




    //agency
    Route::get('/agencys', [AgencyController::class, 'index'])->name('agencys');


    Route::delete('/agencys/{id}', [AgencyController::class, 'destroy'])->name('agencies.destroy');


    //Coordinador

    Route::get('cordinadores', [CordinatorController::class,'index'
    ])->name('cordinador');
    Route::get('/coordinadores/register', [CordinatorController::class, 'create'])->name('coordinador.create');
    Route::post('/coordinadores/register', [CordinatorController::class, 'store'])->name('coordinador.register');

    Route::put('/coordinadores/{coordinatorId}',  [CordinatorController::class, 'updateAgencyId'])->name('user_agency.update');

    Route::delete('/cordinadores/{id}', [CordinatorController::class, 'destroy'])->name('coordinators.destroy');


    //Communitys
    Route::get('/communitys', [CommunityController::class, 'index'])->name('communitys');

    Route::get('/community/register', [CommunityController::class, 'showRegistrationForm'])->name('community.create');
    Route::post('/community/register', [CommunityController::class, 'register'])->name('community.register');
    Route::put('/community/{userId}',  [CommunityController::class, 'updateCordinatorId'])->name('user_cordinator.update');

    Route::delete('/communitys/{id}', [CommunityController::class, 'destroy'])->name('communitys.destroy');


     //clientes

     Route::get('/clientes', [ClientController::class, 'index'])->name('clientes');

     // Mostrar formulario para registrar clientes
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

    // Guardar cliente en la base de datos
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

    // Mostrar formulario para actualizar un cliente
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');

    // Actualizar cliente en la base de datos
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');

    Route::delete('/clients/{id}', [ClientController::class, 'destroy'] )->name('clients.destroy');



});
