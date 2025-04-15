<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Intervenciones\Create\Page AS RegistroDeIntervencionesDirectas;
use App\Livewire\Intervenciones\Edit\Page AS EditarIntervencionesDirectas;
use App\Livewire\Intervenciones\View\Page AS VerIntervencionesDirectas;
use App\Livewire\Intervenciones\Index\Page AS IntervencionesDirectas;

Route::get('/pais/{pais}/intervenciones', RegistroDeIntervencionesDirectas::class)
    ->middleware(['auth', 'verified'])
    ->name('intervenciones.create');

Route::get('/pais/{pais}/intervenciones/{intervencion}/edit', EditarIntervencionesDirectas::class)
    ->middleware(['auth', 'verified'])
    ->name('intervenciones.edit');

Route::get('/pais/{pais}/intervenciones/{intervencion}/view', VerIntervencionesDirectas::class)
    ->middleware(['auth', 'verified'])
    ->name('intervenciones.view');

Route::get('/admin/intervenciones', IntervencionesDirectas::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.intervenciones.index');
