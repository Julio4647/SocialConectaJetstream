<?php

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
    Route::get('/administradores/{id}/actualizar', [GrlController::class, 'actualizaradministradores'])->name('administradores.actualizar');
    Route::put('/administradores/{id}', [GrlController::class, 'updateadministradores'])->name('administradores.update');

    //Coordinador

    Route::get('cordinadores', [GrlController::class,'cordinators'
    ])->name('cordinador');

    //Communitys
    Route::get('communitys', [GrlController::class, 'communitys'])->name('communitys');

});
