<?php

use App\Livewire\FRP\Create\NuevaReferenciaParticipante;
use Illuminate\Support\Facades\Route;
use App\Livewire\FRP\Create\Page AS RegistroReferenciaParticipante;
use App\Livewire\FRP\Index\Page AS ReferenciaParticipante;
use App\Livewire\FRP\Edit\Page AS EditarReferenciaParticipante;
use App\Livewire\FRP\Edit\Seguimiento AS SeguimientoReferenciaParticipante;

/// Registro Referencia Participantes
Route::get('admin/{edad}/referencia-participantes/', ReferenciaParticipante::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.frp.index')
    ->where('edad', 'mayor|menor');

Route::get('/pais/{pais}/{edad}/referencia-participantes', RegistroReferenciaParticipante::class)
    ->middleware(['auth', 'verified'])
    ->name('referencia.create_referencia')
    ->where('edad', 'mayor|menor');

Route::get('/pais/{pais}/{edad}/{referenciaParticipante}/nueva-referencia', NuevaReferenciaParticipante::class)
    ->middleware(['auth', 'verified'])
    ->name('referencia.nueva_referencia')
    ->where('edad', 'mayor|menor');

Route::get('admin/referencia-participantes/{edad}/{referenciaParticipante}/edit', EditarReferenciaParticipante::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.frp.editar')
    ->where('edad', 'mayor|menor');

Route::get('admin/referencia-participantes/{edad}/{referenciaParticipante}/seguimiento', SeguimientoReferenciaParticipante::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.frp.seguimiento')
    ->where('edad', 'mayor|menor');
