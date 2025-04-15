<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\FGSM\Public\SeguimientoFormacionGeneral;


use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;

Volt::route('/', 'pages.auth.login')->name('custom.login');

/**************************FGSM********************************/

// FORMULARIO SEGUIMIENTO
require __DIR__ . '/FGSM/seguimiento.php';



/**************************ADMIN********************************/

require __DIR__ . '/admin/user.php';
require __DIR__ . '/admin/roles.php';
require __DIR__ . '/admin/permisos.php';

require __DIR__ . '/admin/roles.php';



// Intervenciones
require __DIR__ . '/intervencion/intervenciones.php';


/// Referencia Participantes
require __DIR__ . '/FRP/referencia_participante.php';

// Inscripciones
require __DIR__ . '/inscripcion/inscripcion.php';

// Inscripciones
require __DIR__ . '/BuscadorPersonas/buscador.php';

/*
Route::get('/pais/{pais}/intervenciones/{intervencion}/edit', EditarIntervencionesDirectas::class)
    ->middleware(['auth', 'verified'])
    ->name('intervenciones.edit');

Route::get('/admin/intervenciones', IntervencionesDirectas::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.intervenciones.index');*/

#Route::view('/', 'welcome');

require __DIR__ . '/ClubNNA/clubNNA.php';


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::get('/admin/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');





Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
