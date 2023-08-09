<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CalendarController;
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

Route::get('/acceso-denegado', function () {
    return view('errors.403');
})->name('acceso-denegado');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard',[GrlController::class,'index'
    ])->name('dashboard');

    Route::get('/resgistro_usuarios', [GrlController::class,'register'])->name('register')->middleware('role');

    Route::post('/resgistro_usuarios', [GrlController::class,'crearusuarios'])->name('registro.save');

    Route::post('nota/save', [GrlController::class, 'guardarNota'])->name('notaSave');
    Route::post('/search', [GrlController::class, 'search'])->name('notes.search');

    //Administardores

    Route::get('administradores', [GrlController::class, 'administradores'
    ])->name('administradores')->middleware('role');

    Route::get('/crear-administradores', [GrlController::class, 'crearadministradores'
    ])->name('administradores.crear')->middleware('role');

    Route::post('/administradores', [GrlController::class, 'guardaradministradores'])->name('administradores.guardar')->middleware('role');

    Route::delete('/administradores/{id}', [GrlController::class, 'eliminaradministradores'])->name('administradores.eliminar')->middleware('role');
    //Actualizar

    Route::put('/administradores/{id}',  [GrlController::class, 'updateadministradores'])->name('administradores.actualizar')->middleware('role');




    //agency
    Route::get('/agencys', [AgencyController::class, 'index'])->name('agencys')->middleware('role');


    Route::delete('/agencys/{id}', [AgencyController::class, 'destroy'])->name('agencies.destroy')->middleware('role');


    //Coordinador

    Route::get('cordinadores', [CordinatorController::class,'index'
    ])->name('cordinador')->middleware('acceso2');
    Route::get('/coordinadores/register', [CordinatorController::class, 'create'])->name('coordinador.create')->middleware('acceso2');
    Route::post('/coordinadores/register', [CordinatorController::class, 'store'])->name('coordinador.register')->middleware('acceso2');

    Route::put('/coordinadores/{coordinatorId}',  [CordinatorController::class, 'updateAgencyId'])->name('user_agency.update')->middleware('acceso2');

    Route::delete('/cordinadores/{id}', [CordinatorController::class, 'destroy'])->name('coordinators.destroy')->middleware('acceso2');


    //Communitys
    Route::get('/communitys', [CommunityController::class, 'index'])->name('communitys')->middleware('acceso3');;

    Route::get('/community/register', [CommunityController::class, 'showRegistrationForm'])->name('community.create');
    Route::post('/community/register', [CommunityController::class, 'register'])->name('community.register');
    Route::put('/community/{userId}',  [CommunityController::class, 'updateCordinatorId'])->name('user_cordinator.update');

    Route::delete('/communitys/{id}', [CommunityController::class, 'destroy'])->name('communitys.destroy');


     //clientes

     Route::get('/clientes', [ClientController::class, 'index'])->name('clientes');

     // Mostrar formulario para registrar clientes
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create')->middleware('acceso4');

    // Guardar cliente en la base de datos
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

    // Mostrar formulario para actualizar un cliente
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');

    // Actualizar cliente en la base de datos
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');

    Route::delete('/clients/{id}', [ClientController::class, 'destroy'] )->name('clients.destroy');

    Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');

    Route::get('/clients', [ClientController::class, 'reset'])->name('clients.reset');


    //Calendar

    Route::resource('calendar', CalendarController::class)->only(['index','edit','store']);
    Route::controller(CalendarController::class)->group(function () {
    Route::get('getevents','getEvents')->name('calendar.getevents');
    Route::put('update/events','updateEvents')->name('calendar.updateevents');
    Route::post('resize/events','resizeEvents')->name('calendar.resizeevents');
    Route::post('drop/events','dropEvents')->name('calendar.dropevents');
    });

});
